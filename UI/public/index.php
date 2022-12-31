<?php

use App\Views\View;

require_once "../vendor/autoload.php";

$routes = [];

route("home", function () {
    View::renderView(
        "home",
        [
            "fields" => [
                'Loại phòng',
                'Tên phòng',
                'Ngày bắt đầu thuê',
                'Tên khách',
                'Số điện thoại',
                'CMND',
            ],
            "entries" => [
                [
                    ["value" => 'A',],
                    ["value" => 'A1.2',],
                    ["value" => '30/2/2022',],
                    ["value" => 'Nguyễn Văn A',],
                    ["value" => '0999888777',],
                    ["value" => '01010101010',],
                ],
                [
                    ["value" => 'A',],
                    ["value" => 'A1.2',],
                    ["value" => '30/2/2022',],
                    ["value" => 'Nguyễn Văn A',],
                    ["value" => '0999888777',],
                    ["value" => '01010101010',],
                ],
                [
                    ["value" => 'A',],
                    ["value" => 'A1.2',],
                    ["value" => '30/2/2022',],
                    ["value" => 'Nguyễn Văn A',],
                    ["value" => '0999888777',],
                    ["value" => '01010101010',],
                ],
            ]
        ]
    );
});

route("room", function () {
    View::renderView(
        "room",
        [
            "fields" => [
                'STT',
                'Phòng',
                'Loại phòng',
                'Đơn giá',
                'Tình trạng',
                'Chi tiết thuê phòng',
            ],
            "entries" => [
                [
                    ["value" => '1',],
                    ["value" => '1403',],
                    ["value" => 'A',],
                    ["value" => '150.000 VNĐ',],
                    ["value" => 'Trống',],
                ],
                [
                    ["value" => '1',],
                    ["value" => '1403',],
                    ["value" => 'A',],
                    ["value" => '150.000 VNĐ',],
                    ["value" => 'Trống',],
                ],
                [
                    ["value" => '1',],
                    ["value" => '1403',],
                    ["value" => 'A',],
                    ["value" => '150.000 VNĐ',],
                    ["value" => 'Trống',],
                ],
            ]
        ]
    );
});

route("room-booking", function () {
    $action = $_GET['action'] ?? "";

    if ($action == "edit") {
        View::renderView(
            "booking",
            [
                "action" => $action,
                "fields" => [
                    "STT",
                    "Tên phòng",
                    "Loại phòng",
                    "Đơn giá",
                    "Trạng thái",
                ],
                "entries" => [
                    [
                        [
                            "value" => "1",
                        ],
                        [
                            "value" => "1403",
                            "editable" => true
                        ],
                        [
                            "value" => "Chọn loại phòng|Loại A|Loại B|Loại C",
                        ],
                        [
                            "value" => "150.000",
                            "editable" => true
                        ],
                        [
                            "value" => "Trống",
                        ],
                    ]
                ],
                "buttons" =>
                [
                    ["text" => "Lưu thay đổi"]
                ]
            ]
        );
    } else if ($action == "delete") {
        View::renderView(
            "booking",
            [
                "action" => $action,
                "fields" => [
                    "STT",
                    "Tên phòng",
                    "Loại phòng",
                    "Đơn giá",
                    "Trạng thái",
                    "Chọn"
                ],
                "entries" => [
                    [
                        ["value" => "1",],
                        ["value" => "1403",],
                        ["value" => "Loại A",],
                        ["value" => "150.000",],
                        ["value" => "Trống",],
                    ],
                    [
                        ["value" => "2",],
                        ["value" => "1403",],
                        ["value" => "Loại A",],
                        ["value" => "150.000",],
                        ["value" => "Trống",],
                    ],
                    [
                        ["value" => "2",],
                        ["value" => "1403",],
                        ["value" => "Loại A",],
                        ["value" => "150.000",],
                        ["value" => "Trống",],
                    ],
                ],
                "buttons" =>
                [
                    [
                        "text" => "Xóa các dòng đã chọn",
                        "handler" => "deleteSelectedEntries()"
                    ]
                ]
            ]

        );
    } else if ($action == "add") {
        View::renderView(
            "booking",
            [
                "action" => $action,
                "fields" => [
                    "STT",
                    "Tên phòng",
                    "Loại phòng",
                    "Đơn giá",
                    "Trạng thái",
                ],
                "entries" => [
                    [
                        ["value" => "1",],
                        ["value" => "1403", "editable" => true],
                        ["value" => "Chọn loại phòng|Loại A|Loại B|Loại C",],
                        ["value" => "150.000", "editable" => true],
                        ["value" => "Trống",],
                    ]
                ],
                "buttons" =>
                [
                    ["text" => "Thêm"],
                ]

            ]
        );
    } else if ($action == "justify") {
        View::renderView(
            "booking",
            [
                "action" => $action,
                "fields" => [
                    "STT",
                    "Loại phòng",
                    "Đơn giá",
                    "Chọn"
                ],
                "entries" => [
                    [
                        ["value" => "1",],
                        ["value" => "A",],
                        ["value" => "150.000",   "editable" => true],
                    ],
                    [
                        ["value" => "1",],
                        ["value" => "B",],
                        ["value" => "150.000", "editable" => true],
                    ],
                    [
                        ["value" => "1",],
                        ["value" => "C",],
                        ["value" => "150.000", "editable" => true],
                    ],
                    [
                        ["value" => "1",],
                        ["value" => "A",],
                        [
                            "value" => "Điền giá của loại phòng này",
                            "editable" => true
                        ],
                    ],
                ],
                "buttons" =>
                [
                    [
                        "text" => "Lưu thay đổi",
                    ]
                ]

            ]
        );
    } else {
        View::renderView(
            "booking",
            [
                "action" => "view",
                "fields" => [
                    'stt',
                    'Khách hàng',
                    'Loại khách',
                    'CMND',
                    'Địa chỉ',
                ],
                "entries" => [
                    [
                        ["value" => "1",],
                        ["value" => "1403",],
                        ["value" => "Loại A",],
                        ["value" => "150.000",],
                        ["value" => "Trống",],
                    ]
                ]
            ]
        );
    }
});

route("customer", function () {
    View::renderView(
        "customer",
        [
            "fields" => [
                'STT',
                'Mã khách',
                'Họ và tên',
                'Loại khách',
                'CMND',
                'SĐT',
                'Thông tin chi tiết'
            ],
            "entries" => [
                [
                    ["value" => '1',],
                    ["value" => 'KH20221010',],
                    ["value" => 'Đặng Võ Hoàng Kim Tuyền',],
                    ["value" => 'Khách thường',],
                    ["value" => '123456789012',],
                    ["value" => '1234567890',],
                ]
            ]
        ]
    );
});

route("bill", function () {
    View::renderView("bill");
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

        // ![Lỗi]: không thể redirect khi submit form
        if (isset($_POST['username'])) {
            View::redirect("home");
        }
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
    $page = explode('?', $uri)[1] ?? "page=home";
    $route = explode('=', $page)[1];

    if (array_key_exists($route, $routes)) {
        $routes[$route]();
    } else {
        echo "[404] Not found 😔";
    }
}

run();
