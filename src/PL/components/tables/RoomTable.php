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

            $this->sampleEntryFields = [
                "Mã loại phòng" => "MaLoai",
                "Số lượng phòng" => "SoLuongPhong",
                "Đơn giá" => "DonGia",
                "Lượng khách tối đa" => "LuongKhachToiDa",
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

    function makeSelectBox($options, $currentValue)
    {
        $optionsElement = "";
        foreach ($options as $option) {
            $selected = $currentValue == $option ? "selected" : "";
            $optionsElement .= "<option value='$option' $selected>$option</option>";
        }
        return "<select class='input'>$optionsElement</select>";
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

    protected function getTypes()
    {
        $uri = API_ROOT . 'src/BLL/v1/GET/RoomCategoryList.php';
        $Types = fetchAPI($uri);

        $entries = [];
        foreach ($Types as $Type) {
            $entries[] = [
                ["value" => $Type],
            ];
        }
        return $entries;
    }

    // tạo options PK từ ds loại
    protected function makeTypeOptions()
    {
        $Types = $this->getTypes();
        $options = array_map(function ($Type) {
            return $Type[0]['value']['MaLoai'];
        }, $Types);
        return $options;
    }


    protected function renderSampleEntry($fields = [], $action = "add-action")
    {
        $sampleEntryElement = "<div class='sample-entry $action'>";

        foreach ($fields as $title => $name) {
            if ($name == "MaLoai") {
                $options = $this->makeTypeOptions();
                $selectBox = $this->makeSelectBox($options, $options[0]);
                $sampleEntryElement .= <<< EOT
                <div>
                    <label for="$name">$title</label>
                    $selectBox
                </div>
                EOT;
            } else if ($name == "TinhTrang") {
                $options = ['Trống', 'Đã thuê'];
                $selectBox = $this->makeSelectBox($options, $options[0]);
                $sampleEntryElement .= <<< EOT
                <div>
                    <label for="$name">$title</label>
                    $selectBox
                </div>
                EOT;
            } else {
                $sampleEntryElement .= <<< EOT
                <div>
                <label for="$name">$title</label>
                <input class="input" type="text" name="$name" id="$name"></input>
                </div>
                EOT;
            }
        }

        return $sampleEntryElement . '</div>';
    }

    function render()
    {
        $fieldElements = $this->renderFields();

        $checkBoxColumn = $this->makeCheckBoxColumn();
        $entryElements = $this->renderEntries($checkBoxColumn);

        $sampleEntry = $this->action == "add" || $this->action == "justify" ? $this->renderSampleEntry($this->sampleEntryFields) : "";
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