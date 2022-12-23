const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const features = {
    room: 0,
    customer: 1,
    bill: 2,
    report: 3,
}

// Xử lý sự kiện cho các nút bấm
function handleEvents() {
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')

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

    handleButtons(sidebarButtons)
    handleButtons(toolbarButtons)
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

const sidebarButtons = document.querySelector('.sidebar').querySelectorAll('li')
const toolbarButtons = document
    .querySelector('.toolbar')
    .querySelectorAll('button')
const featureTitle = document.querySelector('.feature-title')

// Thêm dòng mới vào bảng, tham số là nội dung điền vào các ô trong dòng mới
function appendRow(data = null) {
    var tbl = document.querySelector('table').getElementsByTagName('tbody')[0]
    tbl.insertRow().innerHTML = data
}

// Xóa dòng trong bảng,
// tham số 1 là danh sách các chỉ số dòng cần xóa (thứ tự giảm dần),
// tham số 2 = true thì xóa hết bảng trừ dòng header, ngược lại chỉ xóa những dòng tương ứng trong tham số 1
function deleteRows(decreased_idx_list, delete_all) {
    var tbl = document.querySelector('table')
    if (delete_all == false) decreased_idx_list.forEach((i) => tbl.deleteRow(i))
    else {
        var i_last_row = tbl.rows.length - 1 // set the last row index
        for (var i = i_last_row; i > 0; i--) tbl.deleteRow(i)
    }
}
// Tham số n_left_row: số dòng muốn giữ lại (không tính dòng header)
function deleteRows(n_left_row) {
    var tbl = document.querySelector('table'),
        i_last = tbl.rows.length - 1,
        i,
        j
    if (n_left_row > i_last) return
    for (i = i_last; i > n_left_row; i--) {
        tbl.deleteRow(i)
    }
}

// Xóa cột cuối (check box)
function deleteColumns(n_left_col) {
    var tbl = document.querySelector('table'),
        i_last = tbl.rows.length - 1,
        j_last = tbl.rows[0].cells.length - 1,
        i,
        j
    for (i = i_last; i >= 0; i--) {
        for (j = j_last; j >= n_left_col; j--) tbl.rows[i].deleteCell(j)
    }
}

function deleteTable(tbl_id) {
    var tbl = document.getElementById(tbl_id),
        i_last_row = tbl.rows.length - 1 // set the last row index
    for (var i = i_last_row; i >= 0; i--) tbl.deleteRow(i)
}

function handleSearch() {
    // tra trong database ---> hien thi
    var tbl = document.querySelector('table'),
        nrow = 10 // TẠM GÁN CỨNG !!!!!
    deleteRows(null, true)
    // headerCell = document.createElement("TH");
    // headerCell.innerHTML = `<tr>
    //                     <th scope="col">STT</th>
    //                     <th scope="col">PHÒNG</th>
    //                     <th scope="col">LOẠI PHÒNG</th>
    //                     <th scope="col">ĐƠN GIÁ</th>
    //                     <th scope="col">TÌNH TRẠNG</th>
    //                     <th scope="col">CHI TIẾT THUÊ PHÒNG</th></tr>`;
    // tbl.rows[0].appendChild(headerCell);
    for (let i = 1; i < nrow; i++) {
        data = `<td scope = "row" > 1</td>
            <td> 1403</td>
            <td>Loại A</td>
            <td>150.000</td>
            <td>Trống</td>
            <td><a href="booking.html"><i class="fa-solid fa-circle-info"></i></a></td>`
        appendRow(data)
    }
}

function handleDelete() {
    // thêm cột checkbox
    console.log('handle delete')
    var tbl = document.querySelector('table'),
        nrow = tbl.rows.length,
        headerCell = document.createElement('TH')
    headerCell.innerHTML = 'CHỌN'
    tbl.rows[0].appendChild(headerCell)
    let n_col = tbl.rows[0].cells.length,
        n_row = nrow // save the number of rows before deleting
    deleteRows(null, true)
    for (let i = 1; i < n_row; i++) {
        data = `<td scope = "row" > 1</td>
            <td> 1403</td>
            <td>Loại A</td>
            <td>150.000</td>
            <td>Trống</td>
            <td><a href="booking.html"><i class="fa-solid fa-circle-info"></i></a></td>
            <td><input type="checkbox">`
        appendRow(data)
    }
    // button xóa các dòng đã chọn, hiện cửa sổ hỏi có chắc chắn?
    var btn = document.createElement('button')
    btn.classList.add('change_button')
    btn.innerHTML = 'Xóa các dòng đã chọn'
    document.body.querySelector('.table-wrapper').appendChild(btn)

    var delete_checkbox_list = () => {
        console.log('delete checkbox')
        for (let i = tbl.rows.length - 1; i > 0; i--) {
            if (
                tbl.rows[i].cells[n_col - 1].getElementsByTagName('INPUT')[0]
                    .checked
            ) {
                tbl.deleteRow(i)
            }
        }
    }
    btn.addEventListener('click', delete_checkbox_list)
}

function handleAdd() {
    console.log('handle add')
    var tbl = document.querySelector('table')
    let n_col = tbl.rows[0].cells.length
    deleteRows(null, true)

    // create new row for insert values
    data = `<td class='default'>1</td>
        <td class='default'>Điền mã phòng</td>
        <td>
            <select data-menu>
                <option selected>Loại A</option>
                <option>Loại B</option>
                <option>Loại C</option>
            </select>
            <!-- dribbble -->
            <a class="dribbble" href=""../assets/icons/up-and-down-arrow.png" alt=""></a>
        </td>
        <td class='default'>Tự động</td>
        <td class='default'>Tình trạng</td>
        <td class='default'>
            <a href = "booking.html"><i class="fa-solid fa-circle-info"></i></a>
        </td>`
    appendRow(data)

    console.log('edit')
    makeEditable(document.querySelector('table'), data)

    // button lưu thay đổi, hiện cửa sổ hỏi có chắc chắn?
    var btn = document.createElement('button')
    btn.classList.add('change_button')
    btn.innerHTML = 'Lưu thay đổi'
    document.body.querySelector('.table-wrapper').appendChild(btn)

    // TODO: ghi database
    var saveChanges = () => {}
    btn.addEventListener('click', saveChanges)
}

function handleEdit() {
    // GÁN CỨNG
    var n_row = 10
    deleteRows(null, true)
    for (let i = 1; i < n_row; i++) {
        data = `<td scope = "row" > 1</td>
            <td> 1403</td>
            <td><select data-menu>
                <option selected>Loại A</option>
                <option>Loại B</option>
                <option>Loại C</option>
            </select>
            <!-- dribbble -->
            <a class="dribbble" href=""../assets/icons/up-and-down-arrow.png" alt=""></a></td>
            <td>150.000</td>
            <td>Trống</td>
            <td><a href="booking.html"><i class="fa-solid fa-circle-info"></i></a></td>`
        appendRow(data)
    }
    makeEditable(document.querySelector('table'))

    // button lưu thay đổi, hiện cửa sổ hỏi có chắc chắn?
    var btn = document.createElement('button')
    btn.classList.add('change_button')
    btn.innerHTML = 'Lưu thay đổi'
    document.body.querySelector('.table-wrapper').appendChild(btn)
    //ghi database
    var saveChanges = () => {
        console.log('ghi database')
    }
    btn.addEventListener('click', saveChanges)
}

function handleRule() {
    console.log('handle rule')
    // delete old table
    deleteRows(null, true)
    tbl = document.querySelector('table')

    // create new header
    var n_room_type = 3
    tbl.rows[0].cells[1].innerHTML = 'LOẠI PHÒNG'
    tbl.rows[0].cells[2].innerHTML = 'ĐƠN GIÁ'
    tbl.rows[0].cells[3].innerHTML = 'CHỌN'
    deleteColumns(4)

    for (var i = 0; i < n_room_type; i++) {
        data = `<td scope="row">1</td>
                <td>Loại A</td>
                <td>150.000</td>
                <td><input type="checkbox">`
        appendRow(data)
    }
    // create new row for insert values
    data = `<td class='default'>1</td>
            <td>Loại A</td>
            <td class='default'>Điền giá của loại phòng này</td>
            <td><input type="checkbox">`
    appendRow(data)
    console.log('edit')
    makeEditable(document.querySelector('table'), data)

    // button lưu thay đổi, hiện cửa sổ hỏi có chắc chắn?
    var btn = document.createElement('button')
    btn.classList.add('change_button')
    btn.innerHTML = 'Lưu thay đổi'
    document.body.querySelector('.table-wrapper').appendChild(btn)
    //ghi database
    var saveChanges = () => {
        console.log('ghi database')
        // xóa
        for (let i = tbl.rows.length - 1; i > 0; i--) {
            if (
                tbl.rows[i].cells[n_col - 1].getElementsByTagName('input')[0]
                    .checked
            ) {
                tbl.deleteRow(i)
            }
        }
        // ghi vào database !!!
    }
    btn.addEventListener('click', saveChanges)
}

function isBlockCell(cells, i, n_col) {
    var n = cells.length,
        col = i % n_col

    // bảng thay đổi quy định
    if (n == 3) {
        if (col == 0) return true
        return false
    }
    // bảng danh sách phòng
    else {
        if (col == 1 || col == 2) return false
        return true
    }
}

function makeEditable(tbl, default_row = null) {
    // ref link: https://code-boxx.com/editable-html-table/
    var cells = tbl.getElementsByTagName('td'),
        n_col = tbl.rows[0].cells.length,
        n_row = tbl.rows.length,
        n = cells.length,
        i

    // (A) INITIALIZE - DOUBLE CLICK TO EDIT CELL
    for (i = 0; i < n; i++) {
        if (isBlockCell(cells, i, n_col)) continue
        else {
            let cell = cells[i] // add this line for not raising errors !!!
            let i_cell = i
            cell.ondblclick = () => editable.edit(cell, i_cell) // call function below in 'var editable'
        }
    }

    var editable = {
        // (B) PROPERTIES
        selected: null, // current selected cell
        value: '', // current selected cell value

        // (C) "CONVERT" TO EDITABLE CELL
        edit: (cell, i_cell) => {
            // (C1) REMOVE "DOUBLE CLICK TO EDIT"
            cell.ondblclick = ''

            // (C2) EDITABLE CONTENT
            cell.contentEditable = true
            cell.focus()

            // (C3) "MARK" CURRENT SELECTED CELL
            editable.selected = cell
            editable.value = cell.innerHTML

            // (C4) PRESS ENTER/ESC OR CLICK OUTSIDE TO END EDIT
            window.addEventListener('click', editable.close)
            cell.onkeydown = (evt) => {
                console.log(i_cell)
                if (evt.key == 'Enter' || evt.key == 'Escape') {
                    editable.close(evt.key == 'Enter' ? true : false)
                    // tạo thêm dòng mới khi nhấn enter tại cột thứ 2 sau cột STT:
                    // kiểm tra cell có nằm trên dòng cuối cùng hay chưa
                    // nếu chưa thì thêm dòng mới
                    if (parseInt(i_cell / n_col) == n_row - 2) {
                        if (i_cell % n_col == 1 || n_row == 4) {
                            appendRow(default_row)
                            makeEditable(
                                document.querySelector('.table-wrapper'),
                                default_row,
                            )
                        }
                    }
                    return
                }
            }
        },

        // (D) END "EDIT MODE"
        close: (evt) => {
            if (evt.target != editable.selected) {
                // (D1) CANCEL - RESTORE PREVIOUS VALUE
                if (evt === false) {
                    editable.selected.innerHTML = editable.value
                }

                // (D2) REMOVE "EDITABLE"
                window.getSelection().removeAllRanges()
                editable.selected.contentEditable = false

                // (D3) RESTORE CLICK LISTENERS
                window.removeEventListener('click', editable.close)
                let cell = editable.selected
                cell.ondblclick = () => editable.edit(cell)

                // (D4) "UNMARK" CURRENT SELECTED CELL
                //editable.selected.classList.remove("edit");
                editable.selected = null
                editable.value = ''

                // (D5) DO WHATEVER YOU NEED
                if (evt !== false) {
                    // check value?
                    // send value to server?
                    // update calculations in table?
                    cell.style.color = 'blue'
                }
            }
        },
    }
}
