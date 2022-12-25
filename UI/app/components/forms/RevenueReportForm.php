<?php
namespace App\Components\Forms;
use App\Components\TableComponent;

class RevenueReportForm extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);
        $this->month = $props['month'];
    }

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();
        
        return <<< EOT
        <form class="report-form">
            <h2 class="form-title">Báo cáo doanh thu theo loại phòng</h2>
            <div class="form-month">Tháng <p>$this->month</p></div>
            <div class="form-table">
                <table class="scrollable">
                    <thead>
                        $fieldElements
                    </thead>
                    <tbody>
                        $entryElements
                    </tbody>
                </table>
                <hr>
                <div class="form-summary">
                    <span>
                        Tổng doanh thu
                    </span>
                    <span class="total-revenue">
                        450.000.000 VNĐ
                    </span>
                </div>
            </div>
        </form>
        EOT;
    }
}
?>

<!-- Style -->
<link rel="stylesheet" href="./css/Form.css" />
