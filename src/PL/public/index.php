<?php

use Views\View;

require_once "../vendor/autoload.php";

//! Có thể sửa hotel_management thành tên thư mục tùy ý
define("API_ROOT", "http://localhost/hotel_management/");

$routes = [];

function fetchAPI($uri)
{
    $response = file_get_contents($uri);
    $response = json_decode($response, true);

    if ($response['success'] == true) {
        return $response['result'];
    } else {
        $message = $response['message'];
        echo $message;
    }
}

function getRoomTypes($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v1/GET/RoomCategoryList.php';
    $roomTypes = fetchAPI($uri);

    $entries = [];
    foreach ($roomTypes as $index => $roomType) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $roomType['MaLoai'], "editable" => $editable],
            ["value" => $roomType['SoLuongPhong'], "editable" => $editable],
            ["value" => $roomType['DonGia'], "editable" => $editable],
            ["value" => $roomType['LuongKhachToiDa'], "editable" => $editable],
        ];
    }
    return $entries;
}

function makeRoomTypeOptions()
{
    $roomTypes = getRoomTypes();
    $options = array_map(function ($roomType) {
        return $roomType[1]['value'];
    }, $roomTypes);
    return $options;
}

function getRooms($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v2/GET/RoomList.php';
    $rooms = fetchAPI($uri);

    $entries = [];
    foreach ($rooms as $index => $room) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $room['MaPhong'], "editable" => $editable],
            ["value" => $room['MaLoai'], "options" => makeRoomTypeOptions()],
            ["value" => $room['DonGia']],
            ["value" => $room['TinhTrang'], "editable" => $editable],
        ];
    }
    return $entries;
}

function getBookings($editable = false)
{
    $uri =  API_ROOT . 'src/BLL/v1/GET/BookingList.php';
    $bookings = fetchAPI($uri);

    //? Thiếu trường 'ngày bắt đầu thuê' và 'số ngày thuê'
    $entries = [];
    foreach ($bookings as $index => $booking) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $booking['SoPhieuThue'], "editable" => $editable],
            ["value" => $booking['ID_KhachHang'], "editable" => $editable],
            ["value" => $booking['MaPhong'], "editable" => $editable],
        ];
    }
    return $entries;
}

function getCustomerTypes($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v1/GET/CustomerTypeList.php';
    $customerTypes = fetchAPI($uri);

    $entries = [];
    foreach ($customerTypes as $index => $customerType) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $customerType['MaLoaiKhach'], "editable" => $editable],
            ["value" => $customerType['TenLoaiKhach'], "editable" => $editable],
            ["value" => $customerType['HeSo'], "editable" => $editable],
        ];
    }
    return $entries;
}

function makeCustomerTypeOptions()
{
    $customerTypes = getCustomerTypes();
    $options = array_map(function ($customerType) {
        return $customerType[1]['value'];
    }, $customerTypes);
    return $options;
}

function getCustomers($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v1/GET/CustomerList.php';
    $customers = fetchAPI($uri);

    $entries = [];
    foreach ($customers as $index => $customers) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $customers['IDKhachHang'], "editable" => $editable],
            ["value" => $customers['LoaiKhach'], "options" => makeCustomerTypeOptions()],
            ["value" => $customers['HoTen'], "editable" => $editable],
            ["value" => $customers['DiaChi'], "editable" => $editable],
            ["value" => $customers['SoDienThoai'], "editable" => $editable],
            ["value" => $customers['CMND'], "editable" => $editable]
        ];
    }
    return $entries;
}

function getSurcharges($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v1/GET/SurchargeList.php';
    $surcharges = fetchAPI($uri);

    $entries = [];
    foreach ($surcharges as $index => $surcharge) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $surcharge['MaPhuThu'], "editable" => $editable],
            ["value" => $surcharge['TenPhuThu'], "editable" => $editable],
            ["value" => $surcharge['TiLe'], "editable" => $editable],
        ];
    }
    return $entries;
}

function makeSurchargeOptions()
{
    $surcharges = getSurcharges();
    $options = array_map(function ($surcharges) {
        return $surcharges[1]['value'];
    }, $surcharges);
    return $options;
}

function getBills($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v1/GET/BillList.php';
    $bills = fetchAPI($uri);

    $entries = [];
    foreach ($bills as $index => $bill) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $bill['SoHoaDon'], "editable" => $editable],
            ["value" => $bill['ID_KhachHang']?? "Chưa cập nhật"],
            ["value" => $bill['NgayThanhToan'], "editable" => $editable],
            ["value" => $bill['TriGia']?? "Chưa cập nhật"],
        ];
    }
    return $entries;
}

function getBillDetails($editable = false)
{
    $uri = API_ROOT . 'src/BLL/v1/GET/BillDetail.php';
    
    $details = fetchAPI($uri);

    $entries = [];
    foreach ($details as $index => $detail) {
        $entries[] = [
            ["value" => $index + 1],
            ["value" => $detail['SoHoaDon'], "editable" => $editable],
            ["value" => $detail['SoNgayThueThuc']],
            ["value" => $detail['TienThuePhong']],
            ["value" => $detail['PhuThu'], "options" => makeSurchargesOptions()],
        ];
    }
    return $entries;
}

route("home", function () {
    $uri =  API_ROOT . 'src/BLL/v1/GET/BookingList.php';
    $bookings = fetchAPI($uri);

    $entries = [];
    foreach ($bookings as $index => $booking) {
        if ($index > 5) break;
        $entry = [
            ["value" => $index + 1],
            ["value" => $booking['SoPhieuThue']],
            ["value" => $booking['ID_KhachHang']],
            ["value" => $booking['NgayBatDauThue']],
            ["value" => $booking['SoNgayThue']],
            ["value" => $booking['MaPhong']],
        ];
        $entries[] = $entry;
    }

    View::renderView("home", ["entries" => $entries]);
});

route("room", function () {
    $action = $_GET['action'] ?? "view";

    if ($action == "add") {
        View::renderView("room", [
            "action" => $action,
            "entries" => getRooms(),
            "buttons" =>
            [
                ["text" => "Thêm", "handler" => "addRoomHandler()"],
            ]
        ]);
    } else if ($action == "delete") {
        View::renderView("room", [
            "action" => $action,
            "entries" => getRooms(),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteRoomHandler()"],
                ["text" => "Chọn tất cả", "handler" => "selectAllEntries()"],
            ]
        ]);
    } else if ($action == "edit") {
        View::renderView("room", [
            "action" => $action,
            "entries" => getRooms(true),
            "buttons" => [
                ["text" => "Lưu thay đổi", "handler" => "addRoomHandler()"],
            ],
        ]);
    } else if ($action == "justify") {
        View::renderView("room", [
            "action" => $action,
            "entries" => getRoomTypes(true),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn",],
                ["text" => "Lưu thay đổi"],
            ]
        ]);
    } else {
        View::renderView("room", [
            "action" => $action,
            "entries" => getRooms(),
        ]);
    }
});

route("booking", function () {
    $action = $_GET['action'] ?? "view";

    if ($action == "add") {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookings(),
            "buttons" =>
            [
                ["text" => "Thêm"],
            ]
        ]);
    } else if ($action == "delete") {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookings(),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn",],
                ["text" => "Lưu thay đổi",],
            ]
        ]);
    } else if ($action == "edit") {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookings(true),
            "buttons" => [
                ["text" => "Lưu thay đổi"],
            ]
        ]);
    } else if ($action == "justify") {
        View::renderView("booking", ["action" => $action]);
    } else {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookings(),
        ]);
    }
});

route("customer", function () {
    $action = $_GET['action'] ?? "view";

    if ($action == "add") {
        View::renderView("customer", [
            "action" => $action,
            "entries" => getCustomers(),
            "buttons" =>
            [
                ["text" => "Thêm", "handler" => "addCustomerHandler()"],
            ]
        ]);
    } else if ($action == "delete") {
        View::renderView("customer", [
            "action" => $action,
            "entries" => getCustomers(),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteCustomerHandler()"],
                ["text" => "Chọn tất cả", "handler" => "selectAllEntries()"],
            ]
        ]);
    } else if ($action == "edit") {
        View::renderView("customer", [
            "action" => $action,
            "entries" => getCustomers(true),
            "buttons" => [
                ["text" => "Lưu thay đổi", "handler" => "updateCustomerHandler()"],
            ],
        ]);
    } else if ($action == "justify") {
        View::renderView("customer", [
            "action" => $action,
            "entries" => getCustomerTypes(true),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteCustomerTypeHandler()"],
                ["text" => "Lưu thay đổi", "handler" => "updateCustomerTypeHandler()"],
            ]
        ]);
    } else {
        View::renderView("customer", [
            "action" => $action,
            "entries" => getCustomers(),
        ]);
    }
});

route("bill", function () {
    $action = $_GET['action'] ?? "view";

    if ($action == "add") {
        View::renderView("bill", [
            "action" => $action,
            "entries" => getBills(),
            "buttons" =>
            [
                ["text" => "Thêm", "handler" => "addBillHandler()"],
            ]
        ]);
    } else if ($action == "delete") {
        View::renderView("bill", [
            "action" => $action,
            "entries" => getBills(),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteBillHandler()"],
                ["text" => "Chọn tất cả", "handler" => "selectAllEntries()"],
            ]
        ]);
    } else if ($action == "edit") {
        View::renderView("bill", [
            "action" => $action,
            "entries" => getBills(true),
            "buttons" => [
                ["text" => "Lưu thay đổi", "handler" => "updateBillHandler()"],
            ],
        ]);
    } else if ($action == "justify") {
        View::renderView("bill", [
            "action" => $action,
            "entries" => getSurcharges(true),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteSurcharge()"],
                ["text" => "Lưu thay đổi", "handler" => "updateSurchargeHandler()"],
            ]
        ]);
    } else {
        View::renderView("bill", [
            "action" => $action,
            "entries" => getBills(),
        ]);
    }
});

route ("bill-detail", function () {
    $action = $_GET['action'] ?? "view";

    if ($action == "add") {
        View::renderView("bill-detail", [
            "action" => $action,
            "entries" => getBillDetail(),
            "buttons" =>
            [
                ["text" => "Thêm", "handler" => "addBillDetailHandler()"],
            ]
        ]);
    } else if ($action == "delete") {
        View::renderView("bill-detail", [
            "action" => $action,
            "entries" => getBillDetail(),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteBillDetailHandler()"],
                ["text" => "Chọn tất cả", "handler" => "selectAllEntries()"],
            ]
        ]);
    } else if ($action == "edit") {
        View::renderView("bill-detail", [
            "action" => $action,
            "entries" => getBillDetail(true),
            "buttons" => [
                ["text" => "Lưu thay đổi", "handler" => "updateBillDetailHandler()"],
            ],
        ]);
    } else if ($action == "justify") {
        View::renderView("bill-detail", [
            "action" => $action,
            "entries" => getBillDetail(true),
            "buttons" =>
            [
                ["text" => "Xóa các dòng đã chọn", "handler" => "deleteBillDetailHandler()"],
                ["text" => "Lưu thay đổi", "handler" => "updateBillDetailHandler()"],
            ]
        ]);
    } else {
        View::renderView("bill-detail", [
            "action" => $action,
            "entries" => getBillDetail(),
        ]);
    }
});

route("report", function () {
    View::renderView("report");
});

route("form", function () {
    $formType = $_GET['type'] ?? "";

    if ($formType == 'report') {
        $month = $_GET['month'] ?? "";

        View::renderView("form", [
            "type" => "revenue-report",
            "month" => $month,
            "fields" =>
            [
                'STT',
                'Loại phòng',
                'Doanh thu',
                'Tỷ lệ',
            ],
            "entries" =>
            [
                [
                    ["value" => '1',],
                    ["value" => 'A',],
                    ["value" => '150.000.000',],
                    ["value" => '33.3%',],
                ],
                [
                    ["value" => '1',],
                    ["value" => 'A',],
                    ["value" => '150.000.000',],
                    ["value" => '33.3%',],
                ],
                [
                    ["value" => '1',],
                    ["value" => 'A',],
                    ["value" => '150.000.000',],
                    ["value" => '33.3%',],
                ],
            ]
        ]);
        View::renderView("form", [
            "type" => "room-report",
            "month" => $month,
            "fields" =>
            [
                'STT',
                'Phòng',
                'Số ngày thuê',
                'Tỷ lệ',
            ],
            "entries" =>
            [
                [
                    ["value" => '1',],
                    ["value" => 'A1.2',],
                    ["value" => '11',],
                    ["value" => '33.3%',],
                ],
                [
                    ["value" => '1',],
                    ["value" => 'A1.2',],
                    ["value" => '11',],
                    ["value" => '33.3%',],
                ],
                [
                    ["value" => '1',],
                    ["value" => 'A1.2',],
                    ["value" => '11',],
                    ["value" => '33.3%',],
                ],
            ]
        ]);
    } else {
        View::renderView("form", [
            "type" => $formType
        ]);
    }
});

// Hàm thêm route
function route(string $path, callable $callback)
{
    global $routes;
    $routes[$path] = $callback;
}

// Hàm chạy route dựa trên request uri
function run()
{
    global $routes;

    $uri = $_SERVER['REQUEST_URI'];
    $route = explode('/', $uri);
    $route = end($route);
    $route = $route  == "" ? "home" : $route;
    $route = explode('?', $route)[0];


    if (array_key_exists($route, $routes)) {
        $routes[$route]();
    } else {
        echo "[404] Not found 😔";
    }
}

run();
