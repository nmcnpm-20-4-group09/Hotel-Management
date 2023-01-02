const $ = document.querySelector.bind(document)
const API_ROOT = 'http://localhost/hotel_management/'

const features = {
    room: 0,
    booking: 1,
    customer: 2,
    bill: 3,
    report: 4,
}

// Reload trang
function reload(delayInSeconds = 1) {
    setTimeout(() => window.location.reload(), delayInSeconds * 1000)
}

// Xử lý sự kiện
function handleEvents() {
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')
    const editableFields = $('.table-wrapper')?.querySelectorAll(
        '[contenteditable=true]',
    )
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
                    e.target.style.color = '#47b5ff'
                    e.target.classList.add('edited')
                })
            })
        }
    }

    handleButtons(sidebarButtons)
    handleButtons(toolbarButtons)
    handleFieldChange(editableFields)
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
    const errorMessage = $('.table-wrapper').querySelector('.error-message')
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
            setTimeout(() => (errorMessage.textContent = ''), 3000) // xóa thông điệp hiển thị
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

            errorMessage.textContent = errors.join('. ')
            errorMessage.classList.add('fail')
        }
    } else {
        errors.push(
            'Cả ba trường mã phòng, mã loại phòng và tình trạng không được để trống',
        )
        errorMessage.textContent = errors.join(', ')
        errorMessage.classList.add('fail')
    }

    // Lấy dữ liệu nhập vào từ các trường
    function getRoomInfo(inputs) {
        const [roomID, roomType, roomStatus] = Array.from(inputs).map(
            (input) => input.value,
        )
        return [roomID, roomType, roomStatus]
    }

    // Gọi API để thêm phòng
    async function addRoom(roomPrice) {
        const addRoomAPI =
            API_ROOT +
            `src/BLL/v1/POST/RoomList.php?MaPhong=${roomID}&MaLoai=${roomType}&TinhTrang=${roomStatus}`

        try {
            const addRoomResponse = await fetch(addRoomAPI)
            const addRoomData = await addRoomResponse.json()
            const { success, message, result } = addRoomData

            errorMessage.textContent = message

            if (!success) errorMessage.classList.add('fail')
            else {
                errorMessage.classList.remove('fail')
                addRoomToUI()
            }
        } catch (e) {
            errorMessage.textContent = e
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
function deleteRoomHandler() {
    const errorMessage = $('.table-wrapper').querySelector('.error-message')
    const entries = $('table tbody').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    const errors = []

    if (selectedEntries.length) {
        if (confirm('Bạn có chắc là muốn xóa những phòng này?')) {
            selectedEntries.forEach(async function (entry) {
                // Lấy mã phòng của phòng
                const roomID = entry.querySelectorAll('tr:nth-of-type(2)').textContent

                // Xóa ở phía database
                await deleteRoom(roomID)

                // Cập nhật ở phía giao diện
                deleteRoomOnUI(roomID)
            })
        }
    }

    async function deleteRoom(roomID) {
        const deleteRoomAPI =
            API_ROOT + `src/BLL/v1/DELETE/RoomList.php?MaPhong=${roomID}` //! Chưa có API

        try {
            const deleteRoomResponse = await fetch(deleteRoomAPI)
            const deleteRoomData = await deleteRoomResponse.json()

            if (deleteRoomData['result'] === 'success') {
                deleteRoomOnUI(roomID)
                errorMessage.classList.remove('fail')
            } else {
                errors.push(deleteRoomData['message'])
                errorMessage.classList.add('fail')
            }
        } catch (e) {
            errors.push(e)
            errorMessage.classList.add('fail')
        }
        
        errorMessage.textContent = errors.join(', ')
    }

    function deleteRoomOnUI(roomID) {
        selectedEntries
            .find((entry) => entry[1].textContent === roomID)
            ?.remove()
    }
}
