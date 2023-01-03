<?php

namespace Components\Tables;

use Components\TableComponent;

class RoomTable extends TableComponent
{
    function __construct($props = [])
    {
        parent::__construct($props);

        if (empty($this->fields)) {
            $this->fields = [
                'STT',
                'Mã phòng',
                'Loại phòng',
                'Đơn giá',
                'Tình trạng',
            ];
        }

        // Chế độ xóa có thêm check box để chọn nên cần thêm field này vào tiêu đề cột
        if ($this->action == "delete")  $this->fields[] = "Chọn";

        // Chế độ chỉnh sửa có dữ liệu lấy từ bảng loại phòng
        if ($this->action == "justify") {
            $this->fields = [
                "STT",
                "Mã loại phòng",
                "Số lượng phòng",
                "Đơn giá",
                "Lượng khách tối đa",
                "Chọn",
            ];
        }

        if ($this->action == "add") {
            $this->sampleEntryFields = [
                "Mã phòng" => "MaPhong",
                "Loại phòng" => "MaLoai",
                "Tình trạng" => "TinhTrang"
            ];
        }
    }

    private function makeSelectBox($options, $currentValue)
    {
        $optionsElement = "";
        foreach ($options as $option) {
            $selected = $currentValue == $option ? "selected" : "";
            $optionsElement .= "<option value='$option' $selected>$option</option>";
        }
        return "<select>$optionsElement</select>";
    }

    function renderEntry($entry)
    {
        $entryElement = "";

        foreach ($entry as $field) {
            $value = $field['value'] ?? '';

            // Thêm select box khi ở chế độ chỉnh sửa và có options
            if ($this->action == "edit" && isset($field['options'])) {
                $selectBox = $this->makeSelectBox($field['options'], $value);

                $entryElement .= <<< EOT
                    <td>$selectBox</td>
                EOT;
            } else {
                // Thêm thuộc tính editable cho các cột có thể chỉnh sửa
                $editable = $field['editable'] ?? false;
                $editableAttribute = $editable ? "contenteditable='true'" : "";

                $entryElement .= <<< EOT
                    <td $editableAttribute name='$value'>$value</td>
                EOT;
            }
        }

        return $entryElement;
    }

    // Tạo checkbox khi ở chế độ delete và justify
    private function makeCheckBoxColumn()
    {
        if ($this->action == "delete" || $this->action == "justify") {
            return "
            <td>
                <label>
                    <input type='checkbox' class='checkbox'>
                    <span class='checkmark'></span> 
                </label>
            </td>
            ";
        }
    }

    function render()
    {
        $fieldElements = $this->renderFields();

        $checkBoxColumn = $this->makeCheckBoxColumn();
        $entryElements = $this->renderEntries($checkBoxColumn);

        $sampleEntry = $this->action == "add" ? $this->renderSampleEntry($this->sampleEntryFields) : "";
        $tableButtons = $this->buttons != [] ?  $this->renderButtons() : "";

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
                $sampleEntry
                <p class="message"></p>
                $tableButtons
            </div>
            EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">