<?php

require "../components/View.php";

class RecentOrders extends TableComponent
{
    public function __construct()
    {
        $this->fields = [
            'Loại phòng',
            'Tên phòng',
            'Ngày bắt đầu thuê',
            'Tên khách',
            'Số điện thoại',
            'CMND',
        ];

        $this->entries = [
            [
                'A',
                'A1.2',
                '30/2/2022',
                'Nguyễn Văn A',
                '0999888777',
                '01010101010',
            ],
        ];
    }

    public function render()
    {
        $orderHeaders = $this->renderHeaders();
        $orderEntries = $this->renderEntries();
        return <<< EOT
        <link rel="stylesheet" href="../css/index.css" />
        <div class="recent-orders">
            <h3>Các phiếu thuê mới nhất</h3>
            <div class="recent-orders-table">
                <table>
                    <thead>
                        $orderHeaders
                    </thead>
                    <tbody>
                        $orderEntries
                    </tbody>
                </table>
            </div>
        </div>
        EOT;
    }
}
