<?php

namespace Components\Tables;

use Components\TableComponent;

class BookingTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);

        $this->fields  = [
            "STT",
            "Số phiếu thuê",
            "Mã khách hàng",
            "Mã phòng",
            "Chi tiết",
        ];
        $this->action = $props['action'] ?? '';
        $this->buttons = $props['buttons'] ?? [];

        // Chế độ xóa có thêm check box để chọn nên cần thêm field này vào tiêu đề cột
        if ($this->action == "delete") $this->addColumn("Chọn");

        // Chế độ thêm có một dòng mẫu
        if ($this->action == "add") {
            $this->entries[] = [
                ["value" => count($this->entries) + 1],
                ["value" => "Số phiếu thuê"],
                ["value" => "Mã khách hàng", "editable" => true],
                ["value" => "Mã phòng", "editable" => true],
            ];
        }

        // Chế độ chỉnh sửa không có chức năng nên xóa hết tiêu đề cột
        if ($this->action == "justify") {
            $this->fields = array();
        }
    }

    protected function renderEntry($entry)
    {
        $entryElement = "";

        foreach ($entry as $field) {
            $value = $field['value'] ?? '';

            // Thêm thuộc tính edtiable cho các cột có thể chỉnh sửa
            $editable = $field['editable'] ?? false;
            $editableAttribute = $editable ? "contenteditable='true'" : "";

            $entryElement .= <<< EOT
                <td $editableAttribute>$value</td>
            EOT;
        }

        return $entryElement;
    }


    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);

            // Thêm nút chi tiết phiếu thuê
            $entryElement .= '
            <td>
                <a href="./booking-detail">
                    <i class="fa-solid fa-circle-info"></i>
                </a>
            </td>';

            // Thêm checkbox vào các dòng
            if ($this->action == "delete" || $this->action == "justify") {
                $entryElement .= "
                <td>
                    <label>
                        <input type='checkbox' class='checkbox'>
                        <span class='checkmark'></span> 
                    </label>
                </td>";
            }



            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    public function renderTableButtons()
    {
        $buttonsElement = "<div class='table-buttons'>";

        foreach ($this->buttons as $button) {
            $text = $button['text'] ?? '';
            $handler = $button['handler'] ?? '';

            $buttonsElement .= <<<EOT
                <button 
                type="button"
                class="save-change-button"
                onclick="$handler"
                >
                    $text
                </button>
            EOT;
        }

        return $buttonsElement . "</div>";
    }

    public function render()
    {


        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();

        // Thêm các
        $tableButtons = $this->buttons != [] ? $this->renderTableButtons() : "";

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

            $tableButtons
        </div>
        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">