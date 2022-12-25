<?php

namespace App\Components\Tables;

use App\Components\TableComponent;

class RecentOrdersTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);
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