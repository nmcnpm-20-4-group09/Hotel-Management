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

// Xóa dòng đã chọn trong bảng
function deleteSelectedEntries() {
    const entries = $('table').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries) {
        selectedEntries.forEach((entry) => {
            entry.remove()
        })
    }
}

// Reload trang
function reload(delayInSeconds = 1) {
    setTimeout(() => window.location.reload(), delayInSeconds * 1000)
}

// Chức năng thêm phòng
async function addRoomHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const errorMessage = $('.table-wrapper').querySelector('.error-message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [roomID, roomType, roomStatus] = getRoomInfo(inputs)

    if (roomID && roomType && roomStatus) {
        // Lấy mã loại phòng
        const roomTypes = await getRoomTypes()

        // Validate dữ liệu
        const isValidRoomID = validateRoomID(roomID)
        const isValidRoomType = roomTypes.includes(roomType)
        const isValidRoomStatus = isNumeric(roomStatus)

        // Nếu đúng hết thì mới gọi API để thêm
        if (isValidRoomID && isValidRoomType && isValidRoomStatus) {
            await addRoom(roomID, roomType, roomStatus)
            reload()
        } else {
            if (!isValidRoomID)
                errors.push(
                    'Định dạng của mã phòng không đúng, định dạng đúng là "P01"',
                )
            if (!isValidRoomType)
                errors.push(
                    'Mã loại phòng không tồn tại, các loại phòng hiện có là: ' +
                        roomTypes.join(', '),
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

    // Lấy ra danh sách loại phòng
    async function getRoomTypes() {
        const getRoomTypesAPI = API_ROOT + `src/BLL/v1/GET/RoomCategoryList.php`

        try {
            const roomTypesResponse = await fetch(getRoomTypesAPI)
            const roomTypesData = await roomTypesResponse.json()
            const roomTypes = Array.from(roomTypesData['result']).map(
                (roomType) => roomType['MaLoai'],
            )
            return roomTypes
        } catch (e) {
            errorMessage.textContent = e
        }

        return []
    }

    // Gọi API để thêm phòng
    async function addRoom(roomID, roomType, roomStatus) {
        const addRoomAPI =
            API_ROOT +
            `src/BLL/v1/POST/RoomList.php?MaPhong=${roomID}&MaLoai=${roomType}&TinhTrang=${roomStatus}`

        try {
            const addRoomResponse = await fetch(addRoomAPI)
            const addRoomData = await addRoomResponse.json()
            const { success, message, result } = addRoomData

            errorMessage.textContent = message

            if (success) errorMessage.classList.remove('fail')
            else errorMessage.classList.add('fail')
        } catch (e) {
            errorMessage.textContent = e
        }
    }
}
