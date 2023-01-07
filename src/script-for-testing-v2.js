function v2_getRoomList() {
    var url = "BLL/v2/GET/RoomList.php";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = v2_onReceiveRoomList;

    xhr.open("GET", url, true);
    xhr.send();
    console.log(url);
}

function v2_onReceiveRoomList() {
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