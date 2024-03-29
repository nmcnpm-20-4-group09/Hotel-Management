<?php

namespace Components\Tables;

use Components\TableComponent;

class CustomerTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);
        if (empty($this->fields)) {
            $this->fields = [
                'STT',
                'Mã khách',
                'Loại khách',
                'Họ và tên',
                'Địa chỉ',
                'SĐT',
                'CMND'
            ];
        }
        // Chế độ xóa có thêm check box để chọn nên cần thêm field này vào tiêu đề cột
        if ($this->action == "delete")  $this->fields[] = "Chọn";

        // Chế độ chỉnh sửa quy định có dữ liệu lấy từ bảng loại phòng
        if ($this->action == "justify") {
            $this->fields = [
                "STT",
                "Mã loại khách",
                "Tên loại khách",
                "Hệ số",
                "Chọn",
            ];

            $this->sampleEntryFields = [
                "Mã loại khách" => "MaLoaiKhach",
                "Tên loại khách" => "TenLoaiKhach",
                "Hệ số" => "HeSo",
            ];
        }

        if ($this->action == "add") {
            $this->sampleEntryFields = [
                "Mã khách" => "IDKhachHang",
                "Loại khách" => "LoaiKhach",
                "Họ và tên" => "HoTen",
                "Địa chỉ" => "DiaChi",
                "Số điện thoại" => "SoDienThoai",
                "CMND" => "CMND"
            ];
        }
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
                    <td $editableAttribute>$value</td>
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

    // Lấy danh sách loại để cho vào select box:
    function getTypes()
    {
        $uri = API_ROOT . 'src/BLL/v1/GET/CustomerTypeList.php';
        $customerTypes = fetchAPI($uri);
        $entries = [];

        foreach ($customerTypes as $index => $customerType) {
            $entries[] = [
                ["value" => $index + 1],
                ["value" => $customerType['MaLoaiKhach']],
                ["value" => $customerType['TenLoaiKhach']],
                ["value" => $customerType['HeSo']],
            ];
        }
        return $entries;
    }

    function renderSampleEntry($fields = [], $action = "add-action")
    {
        $sampleEntryElement = "<div class='sample-entry $action'>";

        foreach ($fields as $title => $name) {
            if ($name != "LoaiKhach") {
                $sampleEntryElement .= <<< EOT
                <div>
                    <label for="$name">$title</label>
                    <input type="text" name="$name" id="$name"></input>
                </div>
            EOT;
            } else {
                $options = $this->makeTypeOptions();
                $selectBox = $this->makeSelectBox($options, $options[0]);
                $sampleEntryElement .= <<< EOT
                <div>
                    <label for="$name">$title</label>
                    $selectBox
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

        // render them option box cho Loai Khach !!!
        $sampleEntry = "";
        if ($this->action == "add")
            $sampleEntry = $this->renderSampleEntry($this->sampleEntryFields, "add-action");
        else if ($this->action == "justify")
            $sampleEntry = $this->renderSampleEntry($this->sampleEntryFields, "justify-action");

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

<style>
    .table-wrapper .sample-entry.add-action input {
        font-size: 1.2rem;
        padding: 10px 8px;
        width: 200px;
    }

    .table-wrapper thead th {
        font-size: 1.6rem;
    }

    .table-wrapper thead th:nth-of-type(2),
    .table-wrapper tbody td:nth-of-type(2) {
        width: 10%;
    }

    .table-wrapper thead th:nth-of-type(n + 6),
    .table-wrapper tbody td:nth-of-type(n + 6) {
        width: 10%;
    }
</style>