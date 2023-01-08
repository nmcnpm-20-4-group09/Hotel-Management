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

    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);

            // Thêm cột chi tiết
            $SoHoaDon = $entry[1]['value'];
            $entryElement .= <<<EOT
                <td>
                <a href='./bill-detail?SoHoaDon={$SoHoaDon}'>
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
        
        $checkBoxColumn = $this->makeCheckBoxColumn();
        $entryElements = $this->renderEntries($checkBoxColumn);

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
                <p class="message"></p>
                $tableButtons
            </div>
            EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">