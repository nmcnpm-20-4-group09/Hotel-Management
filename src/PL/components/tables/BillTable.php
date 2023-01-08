<?php
namespace Components\Tables;
use Components\TableComponent;

class BillTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);

        if (empty($this->fields)) {
            $this->fields = [
                'STT',
                'Số hóa đơn',
                'Mã khách hàng',
                'Ngày thanh toán',
                'Trị giá',
                'Chi tiết',
            ];
        }

        // Chế độ xóa có thêm check box để chọn nên cần thêm field này vào tiêu đề cột
        if ($this->action == "delete")  $this->fields[] = "Chọn";
        
        // Chế độ chỉnh sửa quy định có dữ liệu lấy từ bảng loại phòng
        if ($this->action == "justify") {
            $this->fields = [
                "STT",
                "Mã phụ thu",
                "Tên phụ thu",
                "Tỉ lệ",
                "Chọn",
            ];

            $this->sampleEntryFields = [
                "Mã phụ thu" => "MaPhuThu",
                "Tên phụ thu" => "TenPhuThu",
                "Tỉ lệ" => "TiLe",
            ];
        }

        if ($this->action == "add") {
            $this->sampleEntryFields = [
                "Số hóa đơn" => "SoHoaDon",
                "Mã khách hàng" => "IDKhachHang",
                "Ngày thanh toán" => "NgayThanhToan",
                "Trị giá" => "TriGia",
            ];
        }
    }

    // Thêm nút chi tiết phiếu thuê
    private function makeDetailColumn()
    {
        if ($this->action == "justify")
            return '';
        return '
        <td>
            <a href="./bill-detail">
                <i class="fa-solid fa-circle-info"></i>
            </a>
        </td>';
    }

    function makeSelectBox($options, $currentValue)
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

    function render()
    {
        $fieldElements = $this->renderFields();
        
        $detailColumn = $this->makeDetailColumn();
        $checkBoxColumn = $this->makeCheckBoxColumn();
        $entryElements = $this->renderEntries($detailColumn, $checkBoxColumn);

        $sampleEntry = $this->action == "add" || $this->action =="justify" ? $this->renderSampleEntry($this->sampleEntryFields) : "";
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
                $tableButtons
            </div>
            EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">