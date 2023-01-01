<?php
namespace Components\Tables;
use Components\TableComponent;

class RecentBookingsTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);

        $this-> fields =  [
            "Số thứ tự",
            "Số phiếu thuê",
            "Mã khách hàng",
            "Ngày bắt đầu thuê",
            "Số ngày thuê",
            "Mã phòng"
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