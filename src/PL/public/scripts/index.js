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

// Thêm phòng
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

// Xóa phòng
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

// Chỉnh sửa phòng
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

/*PHIẾU THUÊ*/
// Thêm phiếu thuê
async function addBookingHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const message = $('.table-wrapper').querySelector('.message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [bookingID, customerID, startDate, duration, roomID] = getBookingInfo(inputs)

    



    // Lấy dữ liệu nhập vào từ các trường
    function getBookingInfo(inputs) {
        const bookingInfo = Array.from(inputs).map(
            (input) => input.value,
        )
        return bookingInfo
    }
}
/*KHÁCH*/
// Thêm khách
async function addCustomerHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const message = $('.table-wrapper').querySelector('.message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [IDKhachHang, LoaiKhach, HoTen, DiaChi, SoDienThoai, CMND] = getCustomerInfo(inputs)

    if (IDKhachHang && DiaChi && SoDienThoai && HoTen && CMND) {
        // await addCustomer()
        addCustomerToUI()
    } else {
        errors.push(
            'Cần điền đầy đủ các trường dữ liệu!'
        )
        message.textContent = errors.join(', ')
        message.classList.add('fail')
    }

    // Lấy dữ liệu nhập vào từ các trường
    function getCustomerInfo(inputs) {
        const [IDKhachHang, LoaiKhach, HoTen, DiaChi, SoDienThoai, CMND] = Array.from(inputs).map(
            (input) => input.value,
        )
        return [IDKhachHang, LoaiKhach, HoTen, DiaChi, SoDienThoai, CMND]
    }

    // Gọi API để thêm
    async function addCustomer() {
        const addCustomerAPI =
            API_ROOT +
            `src/BLL/v1/POST/CustomerList.php?IDKhachHang=${IDKhachHang}&LoaiKhach=${LoaiKhach}&HoTen=${HoTen}&DiaChi=${DiaChi}&SoDienThoai=${SoDienThoai}&CMND=${CMND}`

        try {
            const addCustomerResponse = await fetch(addCustomerAPI)
            const addCustomerData = await addCustomerResponse.json()
            const { success, message: queryMessage } = addCustomerData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
        }
    }

    function addCustomerToUI() {
        const entries = $('table tbody').querySelectorAll('tr')
        const newEntry = entries[0].cloneNode(true)
        const fields = newEntry.querySelectorAll('td')
        fields[0].textContent = entries.length + 1
        fields[1].textContent = IDKhachHang
        fields[2].textContent = LoaiKhach
        fields[3].textContent = HoTen
        fields[4].textContent = DiaChi
        fields[5].textContent = SoDienThoai
        fields[6].textContent = CMND
        $('table tbody').appendChild(newEntry)
    }
}

// Sửa thông tin khách
async function updateCustomerHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const editedEntries = Array.from(entries).filter((entry) =>
        entry.querySelector('.edited'),
    )

    const messages = []

    for (entry of editedEntries) {
        const customerInfo = getCustomerInfo(entry)

        // Cập nhật phía database
        const success = await updateCustomer(customerInfo)

        // Cập nhật ở trên giao diện
        updateCustomerOnUI(entry, success)
    }

    function getCustomerInfo(entry) {
        const fields = entry.querySelectorAll('td')
        const MaKhach = fields[1].getAttribute('name')
        const MaKhachMoi = fields[1].textContent
        const LoaiKhach = entry.querySelector('select').value
        const HoTen = fields[3].textContent
        const DiaChi = fields[4].textContent
        const SoDienThoai = fields[5].textContent
        const CMND = fields[6].textContent
        return [MaKhach, MaKhachMoi, LoaiKhach, HoTen, DiaChi, SoDienThoai, CMND]
    }

    async function updateCustomer([MaKhach, MaKhachMoi, LoaiKhach, HoTen, DiaChi, SoDienThoai, CMND]) {
        const updateCustomerAPI =
            API_ROOT +
            `src/BLL/v1/PUT/CustomerList.php?
            IDKhachHang=${MaKhach}&
            IDMoi=${MaKhachMoi}&
            LoaiKhach=${LoaiKhach}&
            HoTen=${HoTen}
            DiaChi=${DiaChi}
            SoDienThoai=${SoDienThoai}
            CMND=${CMND}`

        try {
            const updateCustomerResponse = await fetch(updateCustomerAPI)
            const updateCustomerData = await updateCustomerResponse.json()
            const { success, message: queryMessage } = updateCustomerData

            messages.push(queryMessage)
            return success
        } catch (e) {
            messages.push(e)
            return false
        }
    }

    function updateCustomerOnUI(entry, success) {
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

// Xóa khách
async function deleteCustomerHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries.length) {
        if (confirm('Bạn có chắc là muốn xóa những khách hàng này?')) {
            for (entry of selectedEntries) {
                // Lấy mã khách
                const IDKhachHang = entry.querySelectorAll('td')[1].textContent

                // Xóa ở phía database (khi có code php thì mở comment !!!!)
                //await deleteCustomer(IDKhachHang)

                // Cập nhật ở phía giao diện
                entry.remove()
            }
            // Cập nhật lại STT các dòng:
            const entries = $('table tbody').querySelectorAll('tr')
            i = 1
            for (entry of entries) {
                entry.querySelectorAll('td')[0].textContent = i++
            }
        }
    }

    async function deleteCustomer(MaKhach) {
        const deleteCustomerAPI =
            API_ROOT + `src/BLL/v1/DELETE/CustomerList.php?IDKhachHang=${MaKhach}`

        try {
            const deleteCustomerResponse = await fetch(deleteCustomerAPI)
            const deleteCustomerData = await deleteCustomerResponse.json()
            const { success, message: queryMessage } = deleteCustomerData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
            message.classList.add('fail')
        }
    }
}

// Thêm loại khách
async function addCustomerTypeHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const message = $('.table-wrapper').querySelector('.message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [MaLoai, TenLoai, HeSo] = getCustomerTypeInfo(inputs)

    if (MaLoai && TenLoai && HeSo) {
        // await addCustomerType()
        addCustomerTypeToUI()
    } else {
        errors.push(
            'Cần điền đầy đủ các trường dữ liệu!'
        )
        message.textContent = errors.join(', ')
        message.classList.add('fail')
    }

    // Lấy dữ liệu nhập vào từ các trường
    function getCustomerTypeInfo(inputs) {
        const [MaLoai, TenLoai, HeSo] = Array.from(inputs).map(
            (input) => input.value,
        )
        return [MaLoai, TenLoai, HeSo]
    }

    // Gọi API để thêm
    async function addCustomerType() {
        const addCustomerTypeAPI =
            API_ROOT +
            `src/BLL/v1/POST/CustomerTypeList.php?MaLoaiKhach=${MaLoai}&TenLoaiKhach=${TenLoai}&HeSo=${HeSo}`

        try {
            const addCustomerTypeResponse = await fetch(addCustomerTypeAPI)
            const addCustomerTypeData = await addCustomerTypeResponse.json()
            const { success, message: queryMessage } = addCustomerTypeData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
        }
    }

    function addCustomerTypeToUI() {
        const entries = $('table tbody').querySelectorAll('tr')
        const newEntry = entries[0].cloneNode(true)
        const fields = newEntry.querySelectorAll('td')
        fields[0].textContent = entries.length + 1
        fields[1].textContent = MaLoai
        fields[2].textContent = TenLoai
        fields[3].textContent = HeSo
        $('table tbody').appendChild(newEntry)
    }
}

// Xóa loại khách
async function deleteCustomerTypeHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries.length) {
        if (confirm('Bạn có chắc là muốn xóa những loại khách này?')) {
            for (entry of selectedEntries) {
                // Lấy mã khách
                const MaLoai = entry.querySelectorAll('td')[1].textContent

                // Xóa ở phía database (khi có code php thì mở comment !!!!)
                //await deleteCustomerType(MaLoai)

                // Cập nhật ở phía giao diện
                entry.remove()
            }
            // Cập nhật lại STT các dòng:
            const entries = $('table tbody').querySelectorAll('tr')
            i = 1
            for (entry of entries) {
                entry.querySelectorAll('td')[0].textContent = i++
            }
        }
    }

    async function deleteCustomerType(MaKhach) {
        const deleteCustomerTypeAPI =
            API_ROOT + `src/BLL/v1/DELETE/CustomerTypeList.php?MaLoaiKhach=${MaLoai}`

        try {
            const deleteCustomerTypeResponse = await fetch(deleteCustomerTypeAPI)
            const deleteCustomerTypeData = await deleteCustomerTypeResponse.json()
            const { success, message: queryMessage } = deleteCustomerTypeData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
            message.classList.add('fail')
        }
    }
}

// Sửa quy định loại khách
async function updateCustomerTypeHandler() {
    addCustomerTypeHandler()
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const editedEntries = Array.from(entries).filter((entry) =>
        entry.querySelector('.edited'),
    )

    const messages = []

    for (entry of editedEntries) {
        const CustomerTypeInfo = getCustomerTypeInfo(entry)

        // Cập nhật phía database
        const success = await updateCustomerType(CustomerTypeInfo)

        // Cập nhật ở trên giao diện
        updateCustomerTypeOnUI(entry, success)
    }

    function getCustomerTypeInfo(entry) {
        const fields = entry.querySelectorAll('td')
        const MaLoai = fields[1].getAttribute('name')
        const MaLoaiMoi = fields[1].textContent
        const TenLoai = entry.querySelector('select').value
        const HeSo = fields[3].textContent
        return [MaLoai, MaLoaiMoi, TenLoai, HeSo]
    }

    async function updateCustomerType([MaLoai, MaLoaiMoi, TenLoai, HeSo]) {
        const updateCustomerTypeAPI =
            API_ROOT +
            `src/BLL/v1/PUT/CustomerTypeList.php?
            MaLoaiKhach=${MaLoai}&
            MaLoaiMoi=${MaLoaiMoi}&
            TenLoaiKhach=${TenLoai}&
            HeSo=${HeSo}`

        try {
            const updateCustomerTypeResponse = await fetch(updateCustomerTypeAPI)
            const updateCustomerTypeData = await updateCustomerTypeResponse.json()
            const { success, message: queryMessage } = updateCustomerTypeData

            messages.push(queryMessage)
            return success
        } catch (e) {
            messages.push(e)
            return false
        }
    }

    function updateCustomerTypeOnUI(entry, success) {
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

/* HÓA ĐƠN */
// Thêm hóa đơn
async function addBillHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const message = $('.table-wrapper').querySelector('.message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [SoHoaDon, NgayThanhToan, TriGia] = getBillInfo(inputs)

    if (SoHoaDon && NgayThanhToan && TriGia) {
        // await addBill()
        addBillToUI()
    } else {
        errors.push(
            'Cần điền đầy đủ các trường dữ liệu!'
        )
        message.textContent = errors.join(', ')
        message.classList.add('fail')
    }

    // Lấy dữ liệu nhập vào từ các trường
    function getBillInfo(inputs) {
        const [SoHoaDon, NgayThanhToan, TriGia] = Array.from(inputs).map(
            (input) => input.value,
        )
        return [SoHoaDon, NgayThanhToan, TriGia]
    }

    // Gọi API để thêm
    async function addBill() {
        const addBillAPI =
            API_ROOT +
            `src/BLL/v1/POST/BillList.php?SoHoaDon=${SoHoaDon}&NgayThanhToan=${NgayThanhToan}&TriGia=${TriGia}`

        try {
            const addBillResponse = await fetch(addBillAPI)
            const addBillData = await addBillResponse.json()
            const { success, message: queryMessage } = addBillData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
        }
    }

    function addBillToUI() {
        const entries = $('table tbody').querySelectorAll('tr')
        const newEntry = entries[0].cloneNode(true)
        const fields = newEntry.querySelectorAll('td')
        fields[0].textContent = entries.length + 1
        fields[1].textContent = SoHoaDon
        fields[2].textContent = NgayThanhToan
        fields[3].textContent = TriGia
        $('table tbody').appendChild(newEntry)
    }
}

// Sửa thông tin hóa đơn
async function updateBillHandler() {
    addBillHandler()
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const editedEntries = Array.from(entries).filter((entry) =>
        entry.querySelector('.edited'),
    )

    const messages = []

    for (entry of editedEntries) {
        const BillInfo = getBillInfo(entry)

        // Cập nhật phía database
        const success = await updateBill(BillInfo)

        // Cập nhật ở trên giao diện
        updateBillOnUI(entry, success)
    }

    function getBillInfo(entry) {
        const fields = entry.querySelectorAll('td')
        const SoHoaDon = fields[1].getAttribute('name')
        const SoHoaDonMoi = fields[1].textContent
        const NgayThanhToan = fields[2].textContent
        const TriGia = fields[3].textContent
        return [SoHoaDon, SoHoaDonMoi, NgayThanhToan, TriGia]
    }

    async function updateBill([SoHoaDon, SoHoaDonMoi, NgayThanhToan, TriGia]) {
        const updateBillAPI =
            API_ROOT +
            `src/BLL/v1/PUT/BillList.php?
            SoHoaDon=${SoHoaDon}&
            SoHoaDonMoi=${SoHoaDonMoi}&
            NgayThanhToan=${NgayThanhToan}&
            TriGia=${TriGia}`

        try {
            const updateBillResponse = await fetch(updateBillAPI)
            const updateBillData = await updateBillResponse.json()
            const { success, message: queryMessage } = updateBillData

            messages.push(queryMessage)
            return success
        } catch (e) {
            messages.push(e)
            return false
        }
    }

    function updateBillOnUI(entry, success) {
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

// Xóa hóa đơn
async function deleteBillHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries.length) {
        if (confirm('Bạn có chắc là muốn xóa những hóa đơn này?')) {
            for (entry of selectedEntries) {
                // Lấy mã khách
                const SoHoaDon = entry.querySelectorAll('td')[1].textContent

                // Xóa ở phía database (khi có code php thì mở comment !!!!)
                //await deleteBill(SoHoaDon)

                // Cập nhật ở phía giao diện
                entry.remove()
            }
            // Cập nhật lại STT các dòng:
            const entries = $('table tbody').querySelectorAll('tr')
            i = 1
            for (entry of entries) {
                entry.querySelectorAll('td')[0].textContent = i++
            }
        }
    }

    async function deleteBill(SoHoaDon) {
        const deleteBillAPI =
            API_ROOT + `src/BLL/v1/DELETE/BillList.php?SoHoaDon=${SoHoaDon}`

        try {
            const deleteBillResponse = await fetch(deleteBillAPI)
            const deleteBillData = await deleteBillResponse.json()
            const { success, message: queryMessage } = deleteBillData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
            message.classList.add('fail')
        }
    }
}

// Thêm quy định phụ thu
async function addSurchargeHandler() {
    const sampleEntry = $('.table-wrapper').querySelector('.sample-entry')
    const message = $('.table-wrapper').querySelector('.message')
    const inputs = sampleEntry.querySelectorAll('input')

    const errors = []

    // Lấy các trường thông tin nhập vào
    const [MaPhuThu, TenPhuThu, TiLe] = getSurcharge(inputs)

    if (MaPhuThu && TenPhuThu && TiLe) {
        // await addSurcharge()
        addSurchargeToUI()
    } else {
        errors.push(
            'Cần điền đầy đủ các trường dữ liệu!'
        )
        message.textContent = errors.join(', ')
        message.classList.add('fail')
    }

    // Lấy dữ liệu nhập vào từ các trường
    function getSurcharge(inputs) {
        const [MaPhuThu, TenPhuThu, TiLe] = Array.from(inputs).map(
            (input) => input.value,
        )
        return [MaPhuThu, TenPhuThu, TiLe]
    }

    // Gọi API để thêm
    async function addSurcharge() {
        const addSurchargeAPI =
            API_ROOT +
            `src/BLL/v1/POST/SurchargeList.php?MaPhuThu=${MaPhuThu}&TenPhuThu=${TenPhuThu}&TiLe=${TiLe}`

        try {
            const addSurchargeResponse = await fetch(addSurchargeAPI)
            const addSurchargeData = await addSurchargeResponse.json()
            const { success, message: queryMessage } = addSurchargeData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
        }
    }

    function addSurchargeToUI() {
        const entries = $('table tbody').querySelectorAll('tr')
        const newEntry = entries[0].cloneNode(true)
        const fields = newEntry.querySelectorAll('td')
        fields[0].textContent = entries.length + 1
        fields[1].textContent = MaPhuThu
        fields[2].textContent = TenPhuThu
        fields[3].textContent = TiLe
        $('table tbody').appendChild(newEntry)
    }
}

// Sửa quy định phụ thu
async function updateSurchargeHandler() {
    addSurchargeHandler()
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const editedEntries = Array.from(entries).filter((entry) =>
        entry.querySelector('.edited'),
    )

    const messages = []

    for (entry of editedEntries) {
        const SurchargeInfo = getSurchargeInfo(entry)

        // Cập nhật phía database
        //const success = await updateSurcharge(SurchargeInfo)

        // Cập nhật ở trên giao diện
        updateSurchargeOnUI(entry, success)
    }

    function getSurchargeInfo(entry) {
        const fields = entry.querySelectorAll('td')
        const MaPhuThu = fields[1].getAttribute('name')
        const MaMoi = fields[1].textContent
        const TenPhuThu = entry.querySelector('select').value
        const TiLe = fields[3].textContent
        return [MaPhuThu, MaMoi, TenPhuThu, TiLe]
    }

    async function updateSurcharge([MaPhuThu, TenPhuThu, TiLe]) {
        const updateSurchargeAPI =
            API_ROOT +
            `src/BLL/v1/PUT/Surcharge.php?MaPhuThu=${MaPhuThu}`

        try {
            const updateSurchargeResponse = await fetch(updateSurchargeAPI)
            const updateSurchargeData = await updateSurchargeResponse.json()
            const { success, message: queryMessage } = updateSurchargeData

            messages.push(queryMessage)
            return success
        } catch (e) {
            messages.push(e)
            return false
        }
    }

    function updateSurchargeOnUI(entry, success) {
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

// Xóa phụ thu
async function deleteSurchargeHandler() {
    const message = $('.table-wrapper').querySelector('.message')
    const entries = $('table tbody').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries.length) {
        if (confirm('Bạn có chắc là muốn xóa những phụ thu này?')) {
            for (entry of selectedEntries) {
                // Lấy mã khách
                const SoHoaDon = entry.querySelectorAll('td')[1].textContent

                // Xóa ở phía database (khi có code php thì mở comment !!!!)
                //await deleteSurcharge(SoHoaDon)

                // Cập nhật ở phía giao diện
                entry.remove()
            }
            // Cập nhật lại STT các dòng:
            const entries = $('table tbody').querySelectorAll('tr')
            i = 1
            for (entry of entries) {
                entry.querySelectorAll('td')[0].textContent = i++
            }
        }
    }

    async function deleteSurcharge(MaPhuThu) {
        const deleteSurchargeAPI =
            API_ROOT + `src/BLL/v1/DELETE/SurchargeList.php?MaPhuThu=${MaPhuThu}`

        try {
            const deleteSurchargeResponse = await fetch(deleteSurchargeAPI)
            const deleteSurchargeData = await deleteSurchargeResponse.json()
            const { success, message: queryMessage } = deleteSurchargeData

            message.textContent = queryMessage

            if (!success) message.classList.add('fail')
            else message.classList.remove('fail')
        } catch (e) {
            message.textContent = e
            message.classList.add('fail')
        }
    }
}