<?php

namespace Components\Tables;

use Components\TableComponent;

class BookingTable extends TableComponent
{
    function __construct($props = [])
    {
        parent::__construct($props);

        if (empty($this->fields)) {
            $this->fields = [
                "STT",
                "Số phiếu thuê",
                "Mã khách hàng",
                "Ngày bắt đầu thuê",
                "Số ngày thuê",
                "Mã phòng",
                "Chi tiết",
            ];
        }

        // Chế độ delete có thêm check box để chọn nên cần thêm field này vào tiêu đề cột
        if ($this->action == "delete") $this->fields[] = "Chọn";

        // Chế độ add có một dòng mẫu
        if ($this->action == "add") {
            $this->sampleEntryFields = [
                "Số phiếu thuê" => "SoPhieuThue",
                "Mã khách hàng" => "ID_KhachHang",
                "Ngày bắt đầu thuê" => "NgayBatDauThue",
                "Số ngày thuê" => "SoNgayThue",
                "Mã phòng" => "MaPhong"
            ];
        }

        // Chế độ edit không có chức năng nên xóa hết tiêu đề cột
        if ($this->action == "justify") {
            $this->fields = array();
        }
    }

    // Thêm checkbox vào các dòng trong chế độ delete
    private function makeCheckBoxColumn()
    {
        if ($this->action == "delete") {
            return '
            <td>
                <label>
                    <input type="checkbox" class="checkbox">
                    <span class="checkmark"></span> 
                </label>
            </td>';
        }

        return "";
    }

    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);

            // Thêm cột chi tiết
            $bookingID = $entry[0]['value'];
            $entryElement .= <<<EOT
                <td>
                <a href='./booking-detail?bookingID={$bookingID}'>
                    <i class='fa-solid fa-circle-info'></i>
                </a>
            </td>
            EOT;

            // Thêm các column truyền vào nếu có
            foreach (func_get_args() as $column) {
                $entryElement .= $column;
            }

            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    protected function renderSampleEntry($fields = [], $action = "add-action")
    {
        $sampleEntryElement = "<div class='sample-entry $action'>";

        foreach ($fields as $title => $name) {
            $inputType = $name == "NgayBatDauThue" ? "date" : "text";

            $sampleEntryElement .= <<< EOT
                <div>
                    <label for="$name">$title</label>
                    <input type="$inputType" name="$name" id="$name"></input>
                </div>
            EOT;
        }

        return $sampleEntryElement . '</div>';
    }

    function render()
    {
        $fieldElements = $this->renderFields();

        $checkBoxColumn = $this->makeCheckBoxColumn();
        $entryElements = $this->renderEntries($checkBoxColumn);

        $sampleEntry = $this->action == "add" ? $this->renderSampleEntry($this->sampleEntryFields, "add-action") : "";
        $tableButtons = $this->buttons != [] ?  $this->renderButtons() : "";

        return <<< EOT
        <div class="table-wrapper">
            <table class="scrollable">
                <thead>
                    $fieldElements
                </thead>
                <tbody>
                    $entryElements
                </tbody>
            </table>
            $sampleEntry
            <p class="message"></p>
            $tableButtons
        </div>
        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">

<style>
    .table-wrapper .sample-entry.add-action input {
        font-size: 1.2rem;
        padding: 10px 12px;
    }

    .table-wrapper thead th {
        font-size: 1.6rem;
    }

    .table-wrapper tbody td:nth-of-type(2),
    .table-wrapper thead th:nth-of-type(2) {
        width: 10%;
    }

    .table-wrapper tbody td:nth-of-type(n + 6),
    .table-wrapper thead th:nth-of-type(n + 6) {
        width: 10%;
    }

</style>