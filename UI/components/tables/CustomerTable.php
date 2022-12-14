<?php
require_once("../View.php");

class CustomerTable extends TableComponent
{
    private $fields = [
        'STT',
        'Mã khách',
        'Họ và tên',
        'Loại khách',
        'CMND',
        'SĐT',
        'Thông tin chi tiết'
    ];
    private $entries = [
        [
            '1',
            'KH20221010',
            'Đặng Võ Hoàng Kim Tuyền',
            'Khách thường',
            '123456789012',
            '1234567890',
        ],
    ];

    // Ghi đè phương thức của lớp cha
    public function renderFields()
    {
        $headerElements = '';
        $index = 0;

        foreach ($this->fields as $field) {
            // Ba field đầu có nút sort
            if ($index++ < 3) {
                $headerElements .= <<<EOT
                <th scope="col">
                    $field
                    <i class="fa-solid fa-sort"></i>
                </th>
                EOT;
            } else {
                $headerElements .= <<<EOT
                <th scope="col">$field</th>
                EOT;
            }
        }

        return "<tr>" . $headerElements . "</tr>";
    }

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
                <i class="fa-solid fa-circle-info"></i>
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
