<!-- Style -->
<link rel="stylesheet" href="../css/form.css" />

<?php
require_once("../View.php");

class RevenueReportForm extends TableComponent
{
    protected $fields =
    [
        'STT',
        'Loại phòng',
        'Doanh thu',
        'Tỷ lệ',
    ];
    protected $entries =
    [
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
        [
            '1',
            'A',
            '150.000.000',
            '33.3%',
        ],
    ];

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();
        return <<< EOT
        <form class="report-form">
            <h2 class="form-title">Báo cáo doanh thu theo loại phòng</h2>
            <div class="form-month">Tháng <p>12</p></div>
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
