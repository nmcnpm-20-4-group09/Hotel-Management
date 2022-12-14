
<?php
require_once("../View.php");

class RoomTable extends TableComponent
{
    protected $fields = [
        'STT',
        'Phòng',
        'Loại phòng',
        'Đơn giá',
        'Tình trạng',
        'Chi tiết thuê phòng',
    ];
    protected $entries = [
        [
            '1',
            '1403',
            'A',
            '150.000 VNĐ',
            'Trống',
        ],
    ];

    // Ghi đè phương thức của lớp cha
    public function renderEntries()
    {
        $entryElements = '';
        $entry = $this->entries[0];

        // Tạm thời sinh dữ liệu giả
        for ($i = 0; $i < 10; $i++) {
            $entryElement = $this->renderColumns($entry);
            $entryElement .= '
            <td>
                <a href="./booking.php">
                    <i class="fa-solid fa-circle-info"></i>
                </a>
            </td>';
            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();

        return <<<EOT
            <link rel="stylesheet" href="../css/Table.css">

            <div class="table-wrapper">
                <table class="scrollable">
                    <thead>
                        $fieldElements
                    </thead>
                    <tbody>
                        $entryElements
                    </tbody>
                </table>
            </div>
            EOT;
    }
}
