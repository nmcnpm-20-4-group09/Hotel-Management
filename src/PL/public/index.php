<?php

use Views\View;

require_once "../vendor/autoload.php";

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

route("home", function () {
    $uri = 'http://localhost/hotel_management/src/BLL/v1/GET/BookingList.php';
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
    $uri = 'http://localhost/hotel_management/src/BLL/v2/GET/RoomList.php';
    $rooms = fetchAPI($uri);

    $entries = [];
    foreach ($rooms as $index => $room) {
        $entry = [
            ["value" => $index + 1],
            ["value" => $room['MaPhong']],
            ["value" => $room['MaLoai']],
            ["value" => $room['DonGia']],
            ["value" => $room['TinhTrang']],
        ];
        $entries[] = $entry;
    }

    View::renderView("room", ["entries" => $entries]);
});

function getBookingsData($editable = false)
{
    $uri = 'http://localhost/hotel_management/src/BLL/v1/GET/BookingList.php';
    $bookings = fetchAPI($uri);

    //? Trường 'ngày bắt đầu thuê' và 'số ngày thuê' đem qua chi tiết thuê
    $entries = [];
    foreach ($bookings as $index => $booking) {
        $entry = [
            ["value" => $index + 1],
            ["value" => $booking['SoPhieuThue']],
            ["value" => $booking['ID_KhachHang'], "editable" => $editable],
            ["value" => $booking['MaPhong'], "editable" => $editable],
        ];
        $entries[] = $entry;
    }
    return $entries;
}

route("booking", function () {
    $action = $_GET['action'] ?? "view";

    if ($action == "edit") {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookingsData(true),
            "buttons" => [
                ["text" => "Lưu thay đổi"],
            ]
        ]);
    } else if ($action == "delete") {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookingsData(),
            "buttons" =>
            [
                [
                    "text" => "Xóa các dòng đã chọn",
                    "handler" => "deleteSelectedEntries()"
                ],
                [
                    "text" => "Lưu thay đổi",
                ],
            ]
        ]);
    } else if ($action == "add") {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookingsData(),
            "buttons" =>
            [
                ["text" => "Thêm"],
            ]
        ]);
    } else if ($action == "justify") {
        View::renderView("booking", ["action" => $action]);
    } else {
        View::renderView("booking", [
            "action" => $action,
            "entries" => getBookingsData(),
        ]);
    }
});

route("customer", function () {
    $uri = 'http://localhost/hotel_management/src/BLL/v1/GET/CustomerList.php';
    $customers = fetchAPI($uri);

    $entries = [];
    foreach ($customers as $index => $customer) {
        $entry = [
            ["value" => $index + 1],
            ["value" => $customer['IDKhachHang']],
            ["value" => $customer['LoaiKhach']],
            ["value" => $customer['HoTen']],
            ["value" => $customer['SoDienThoai']],
            ["value" => $customer['CMND']],
        ];
        $entries[] = $entry;
    }

    View::renderView("customer", ["entries" => $entries]);
});

route("bill", function () {
    $uri = 'http://localhost/hotel_management/src/BLL/v1/GET/BillList.php';
    $bills = fetchAPI($uri);

    $entries = [];
    foreach ($bills as $index => $bill) {
        $entry = [
            ["value" => $index + 1],
            ["value" => $bill['SoHoaDon']],
            ["value" => $bill['NgayThanhToan']],
            ["value" => $bill['TriGia'] ?? "Chưa có"],
        ];
        $entries[] = $entry;
    }

    View::renderView("bill", ["entries" => $entries]);
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

    $uri = $_SERVER['REQUEST_URI']; // /hotel-management-system/UI/public/home?param=123
    $route = explode('/', $uri)[5]; // home?param=123
    $route = $route  == "" ? "home" : $route; // home?param=123
    $route = explode('?', $route)[0]; // home


    if (array_key_exists($route, $routes)) {
        $routes[$route]();
    } else {
        echo "[404] Not found 😔";
    }
}

run();
