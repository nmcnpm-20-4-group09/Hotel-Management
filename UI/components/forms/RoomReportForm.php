<!-- Style -->
<link rel="stylesheet" href="../css/form.css" />

<?php
require_once("../components/View.php");

class RoomReportForm extends TableComponent
{
    protected $fields =
    [
        'STT',
        'Phòng',
        'Số ngày thuê',
        'Tỷ lệ',
    ];
    protected $entries =
    [
        [
            '1',
            'A1.2',
            '11',
            '33.3%',
        ],
    ];

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();
        return <<< EOT
        <form class="report-form">
            <h2 class="form-title">Báo cáo mật độ sử dụng phòng</h2>
            <div class="form-month">Tháng <p>12</p>
            </div>
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
                        Tổng số ngày thuê
                    </span>
                    <span class="total-using-days">
                        33 ngày
                    </span>
                </div>
            </div>
        </form>
        EOT;
    }
}
?>