<?php
namespace App\Components\Tables;
use App\Components\TableComponent;

class RecentOrdersTable extends TableComponent
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
            [
                'A',
                'A1.2',
                '30/2/2022',
                'Nguyễn Văn A',
                '0999888777',
                '01010101010',
            ],
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
        $orderHeaders = $this->renderFields();
        $orderEntries = $this->renderEntries();

        return <<< EOT
        
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
?>

<link rel="stylesheet" href="./css/RecentOrders.css" />
