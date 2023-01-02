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
                "Mã phòng" => "MaPhong"
            ];
        }

        // Chế độ edit không có chức năng nên xóa hết tiêu đề cột
        if ($this->action == "justify") {
            $this->fields = array();
        }
    }

    // Thêm nút chi tiết phiếu thuê
    private function makeDetailColumn()
    {
        return '
        <td>
            <a href="./booking-detail">
                <i class="fa-solid fa-circle-info"></i>
            </a>
        </td>';
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

    function render()
    {
        $fieldElements = $this->renderFields();

        $detailColumn = $this->makeDetailColumn();
        $checkBoxColumn = $this->makeCheckBoxColumn();
        $entryElements = $this->renderEntries($detailColumn, $checkBoxColumn);

        // TODO: sửa tham số của renderSampleEntry
        $sampleEntry = $this->action == "add" ? $this->renderSampleEntry($this->sampleEntryFields) : "";
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
            $tableButtons
        </div>
        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">