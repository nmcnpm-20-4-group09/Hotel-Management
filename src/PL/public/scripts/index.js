const $ = document.querySelector.bind(document)
const API_ROOT = 'http://localhost/hotel_management/'

const features = {
    room: 0,
    booking: 1,
    customer: 2,
    bill: 3,
    report: 4,
}

// Xử lý sự kiện
function handleEvents() {
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')

    const tableWrapper = $('.table-wrapper')
    const editableFields = tableWrapper?.querySelectorAll(
        '[contenteditable=true]',
    )
    const selectBoxes = tableWrapper?.querySelectorAll('select')

    handleButtons(sidebarButtons)
    handleButtons(toolbarButtons)
    handleFieldChange(editableFields)
    handleSelectBoxChange(selectBoxes)

    function handleButtons(buttons) {
        if (buttons) {
            buttons.forEach((button) => {
                button.addEventListener('click', () => {
                    buttons.forEach((btn) => {
                        btn.classList.remove('active')
                    })

                    button.classList.add('active')
                })
            })
        }
    }

    function handleFieldChange(editableFields) {
        if (editableFields) {
            editableFields.forEach((editableField) => {
                editableField.addEventListener('keydown', (e) => {
                    e.target.classList.add('edited')
                })
            })
        }
    }

    function handleSelectBoxChange(selectBoxes) {
        if (selectBoxes) {
            selectBoxes.forEach((selectBox) => {
                selectBox.addEventListener('change', (e) => {
                    e.target.classList.add('edited')
                })
            })
        }
    }
}

// Thay đổi giao diện của chức năng
function updateFeature(featureIndex) {
    // Cập nhật nút chức năng
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const featureButton = sidebarButtons[features[featureIndex]]
    featureButton?.classList.add('active')

    // Cập nhật tiêu đề chức năng
    const featureTitle = $('.feature-title')
    sidebarButtons.forEach((button) => {
        if (button.classList.contains('active'))
            featureTitle.textContent = button.querySelector('span').textContent
    })
}

// Chọn tất cả các dòng trong bảng
function selectAllEntries() {
    const entries = $('table tbody').querySelectorAll('tr')

    Array.from(entries).forEach((entry) => {
        console.log(entry)
        entry.querySelector('input').checked = true
    })
}

// Lấy ra danh sách loại phòng kèm giá
async function getRoomTypes() {
    const getRoomTypesAPI = API_ROOT + `src/BLL/v1/GET/RoomCategoryList.php`

    try {
        const roomTypesResponse = await fetch(getRoomTypesAPI)
        const roomTypesData = await roomTypesResponse.json()

        const roomTypes = Array.from(roomTypesData['result']).reduce(
            (types, { MaLoai, DonGia }) => {
                return (types[MaLoai] = DonGia), types
            },
            {},
        )
        return roomTypes
    } catch (e) {
        errorMessage.textContent = e
    }

    return []
}

// Chức năng thêm phòng
async function addRoomHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const message = $('.table-wrapper').querySelector('.message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [roomID, roomType, roomStatus] = getRoomInfo(inputs)

    // Lấy các loại phòng
    const roomTypes = await getRoomTypes()

    if (roomID && roomType && roomStatus) {
        // Validate dữ liệu
        const isValidRoomID = validateRoomID(roomID)
        const isValidRoomType = Object.keys(roomTypes).includes(roomType)
        const isValidRoomStatus = isNumeric(roomStatus)

        // Nếu đúng hết thì mới gọi API để thêm
        if (isValidRoomID && isValidRoomType && isValidRoomStatus) {
            await addRoom()
            addRoomToUI()
        } else {
            if (!isValidRoomID)
                errors.push(
                    'Định dạng của mã phòng không đúng, định dạng đúng là "P01"',
                )
            if (!isValidRoomType)
                errors.push(
                    'Mã loại phòng không tồn tại, các loại phòng hiện có là: ' +
                        Object.keys(roomTypes).join(', '),
                )
            if (!isValidRoomStatus) errors.push('Tình trạng cần phải là một số')

            message.textContent = errors.join('. ')
            message.classList.add('fail')
        }
    } else {
        errors.push(
            'Cả ba trường mã phòng, mã loại phòng và tình trạng không được để trống',
        )
        message.textContent = errors.join(', ')
        message.classList.add('fail')
    }

    // Lấy dữ liệu nhập vào từ các trường
    function getRoomInfo(inputs) {
        const [roomID, roomType, roomStatus] = Array.from(inputs).map(
            (input) => input.value,
        )
        return [roomID, roomType, roomStatus]
    }

    // Gọi API để thêm phòng
    async function addRoom() {
        const addRoomAPI =
            API_ROOT +
            `src/BLL/v1/POST/RoomList.php?MaPhong=${roomID}&MaLoai=${roomType}&TinhTrang=${roomStatus}`

        try {
            const addRoomResponse = await fetch(addRoomAPI)
            const addRoomData = await addRoomResponse.json()
            const { success, message: queryMessage } = addRoomData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
        }
    }

    function addRoomToUI() {
        const entries = $('table tbody').querySelectorAll('tr')
        const newEntry = entries[0].cloneNode(true)
        const fields = newEntry.querySelectorAll('td')

        const roomPrice = roomTypes[roomType]

        fields[0].textContent = entries.length + 1
        fields[1].textContent = roomID
        fields[2].textContent = roomType
        fields[3].textContent = roomPrice
        fields[4].textContent = roomStatus

        $('table tbody').appendChild(newEntry)
    }
}

// Chức năng xóa phòng
async function deleteRoomHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries.length) {
        if (confirm('Bạn có chắc là muốn xóa những phòng này?')) {
            for (entry of selectedEntries) {
                // Lấy mã phòng của phòng
                const roomID = entry.querySelectorAll('td')[1].textContent

                // Xóa ở phía database
                await deleteRoom(roomID)

                // Cập nhật ở phía giao diện
                entry.remove()
            }
        }
    }

    async function deleteRoom(roomID) {
        const deleteRoomAPI =
            API_ROOT + `src/BLL/v1/DELETE/RoomList.php?MaPhong=${roomID}`

        try {
            const deleteRoomResponse = await fetch(deleteRoomAPI)
            const deleteRoomData = await deleteRoomResponse.json()
            const { success, message: queryMessage } = deleteRoomData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
            message.classList.add('fail')
        }
    }
}

// Chức năng chỉnh sửa phòng
async function updateRoomHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const editedEntries = Array.from(entries).filter((entry) =>
        entry.querySelector('.edited'),
    )

    const messages = []

    for (entry of editedEntries) {
        const roomInfo = getRoomInfo(entry)

        // Cập nhật phía database
        const success = await updateRoom(roomInfo)

        // Cập nhật ở trên giao diện
        updateRoomOnUI(entry, success)
    }

    function getRoomInfo(entry) {
        const fields = entry.querySelectorAll('td')

        const roomID = fields[1].getAttribute('name')
        const newRoomID = fields[1].textContent
        const newRoomType = entry.querySelector('select').value
        const newRoomStatus = fields[4].textContent

        return [roomID, newRoomID, newRoomType, newRoomStatus]
    }

    async function updateRoom([roomID, newRoomID, newRoomType, newRoomStatus]) {
        const updateRoomAPI =
            API_ROOT +
            `src/BLL/v1/PUT/RoomList.php?
            MaPhong=${roomID}&
            MaPhongMoi=${newRoomID}&
            MaLoai=${newRoomType}&
            TinhTrang=${newRoomStatus}`

        try {
            const updateRoomResponse = await fetch(updateRoomAPI)
            const updateRoomData = await updateRoomResponse.json()
            const { success, message: queryMessage } = updateRoomData

            messages.push(queryMessage)
            return success
        } catch (e) {
            messages.push(e)
            return false
        }
    }

    function updateRoomOnUI(entry, success) {
        const editedFields = entry.querySelectorAll('.edited')
        editedFields.forEach((field) => field.classList.remove('edited'))

        message.textContent = messages.join(', ')

        if (success) message.classList.remove('fail')
        else message.classList.add('fail')

        setTimeout(() => {
            message.textContent = ''
            messages.length = 0
        }, 5000)
    }
}
