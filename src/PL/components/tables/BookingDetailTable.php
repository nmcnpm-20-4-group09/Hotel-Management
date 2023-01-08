<?php

namespace Components\Tables;

use Components\TableComponent;

class BookingDetailTable extends TableComponent
{
    function __construct($props = [])
    {
        parent::__construct($props);

        if (empty($this->fields)) {
            $this->fields = [
                "STT",
                "Mã khách hàng",
                "Loại khách",
                "CMND",
                "Địa chỉ",
            ];
        }

        // Chế độ add có một dòng mẫu
        if ($this->action == "add") {
            $this->sampleEntryFields = [
                "Mã khách hàng" => "ID_KhachHang",
                "Loại khách" => "LoaiKhach",
                "CMND" => "CMND",
                "Địa chỉ" => "DiaChi"
            ];
        }
    }

    function render()
    {
        $fieldElements = $this->renderFields();

        $entryElements = $this->renderEntries();

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
            <p class="message"></p>
            $tableButtons
        </div>
        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">

<style>
    .table-wrapper .th {
        width: 10%;
    }
</style>