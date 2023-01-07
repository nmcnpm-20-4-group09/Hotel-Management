function v1_getBillDetail(soPhieuThue, soHoaDon) {
    var url = "BLL/v1/GET/BillDetail.php".concat(
        "?SoPhieuThue=", soPhieuThue,
        "&SoHoaDon=", soHoaDon
    );

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v1_onReceiveBillDetail;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v1_onReceiveBillDetail() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            for (let i = 0; i < response.length; i++) {
                var details = response[i];
                console.log(details);

                // Un-comment those to get specific data
                // console.log(details['SoPhieuThue']);
                // console.log(details['SoHoaDon']);
                // console.log(details['SoNgayThueThuc']);
                // console.log(details['TienThuePhong']);
                // console.log(details['MaPhuThu']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}

function v1_getCustomerList() {
    var url = "BLL/v1/GET/CustomerList.php";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v1_onReceiveCustomerList;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v1_onReceiveCustomerList() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            for (let i = 0; i < response.length; i++) {
                var customer = response[i];
                console.log(customer);

                // Un-comment those to get specific data
                // console.log(customer['ID_KhachHang']);
                // console.log(customer['LoaiKhach']);
                // console.log(customer['HoTen']);
                // console.log(customer['NgaySinh']);
                // console.log(customer['DiaChi']);
                // console.log(customer['SoDienThoai']);
                // console.log(customer['CMND']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}

function v1_getRoomCategoryList() {
    var url = "BLL/v1/GET/RoomCategoryList.php";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v1_onReceiveRoomCategoryList;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v1_onReceiveRoomCategoryList() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            for (let i = 0; i < response.length; i++) {
                var roomCategory = response[i];
                console.log(roomCategory);

                // Un-comment those to get specific data
                // console.log(roomCategory['MaLoai']);
                // console.log(roomCategory['SoLuongPhong']);
                // console.log(roomCategory['DonGia']);
                // console.log(roomCategory['LuongKhachToiDa']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}

function v1_getRoomList() {
    var url = "BLL/v1/GET/RoomList.php";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v1_onReceiveRoomList;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v1_onReceiveRoomList() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            for (let i = 0; i < response.length; i++) {
                var room = response[i];
                console.log(room);

                // Un-comment those to get specific data
                // console.log(room['MaPhong']);
                // console.log(room['MaLoai']);
                // console.log(room['TinhTrang']);
                // console.log(room['GhiChu']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}

function v1_updateSurcharge() {
    var data = {
        "MaPhuThu": "PT01",
        "TiLeMoi": Math.random()
    };

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = v1_onReceiveUpdateSurcharge;

    xhr.open("PUT", "BLL/v1/PUT/Surcharge.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(data));

    console.log(
        'PUT: Surcharge.php, data: '
        + JSON.stringify(data)
    );
}

function v1_onReceiveUpdateSurcharge() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            if (response.length == 0)
                console.log("No things was update");
            else
                console.log("Changed: ");

            for (let i = 0; i < response.length; i++) {
                var surcharge = response[i];
                console.log(surcharge);

                // Un-comment those to get specific data
                // console.log(surcharge['MaPhong']);
                // console.log(surcharge['MaLoai']);
                // console.log(surcharge['TinhTrang']);
                // console.log(surcharge['GhiChu']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}

function v1_getBillList() {
    var url = "BLL/v1/GET/BillList.php";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v1_onReceiveRoomList;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v1_onReceiveBillList() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            for (let i = 0; i < response.length; i++) {
                var bill = response[i];
                console.log(bill);

                // Un-comment those to get specific data
                // console.log(bill['SoHoaDon']);
                // console.log(bill['NgayThanhToan']);
                // console.log(bill['TriGia']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}

function v1_getBookingDetail(soPhieuThue) {
    var url = "BLL/v1/GET/BookingDetail.php".concat(
        "?SoPhieuThue=", soPhieuThue
    );

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v1_onReceiveBookingDetail;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v1_onReceiveBookingDetail() {
    if (this.readyState == 4 && this.status == 200) {
        var received = JSON.parse(this.responseText);

        if (received['success']) {
            var response = received['result'];

            for (let i = 0; i < response.length; i++) {
                var details = response[i];
                console.log(details);

                // Un-comment those to get specific data
                // console.log(details['SoPhieuThue']);
                // console.log(details['ID_KhachHang']);
            }
        }
        else {
            console.log(received['message']);
        }
    }
}
