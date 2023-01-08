<?php

namespace Components;

abstract class Component
{
    abstract public function render();
};

abstract class TableComponent extends Component
{
    public function __construct($props = [])
    {
        $this->fields = $props['fields'] ?? [];
        $this->entries = $props['entries'] ?? [];
        $this->action = $props['action'] ?? [];
        $this->buttons = $props['buttons'] ?? [];
    }


    // Tạo ra dòng tiêu đề trong bảng
    // - return: chuỗi html của dòng tiêu đề
    protected function renderFields()
    {
        $headerElements = '';

        foreach ($this->fields as $field) {
            $headerElements .= <<<EOT
                <th scope="col">{$field}</th>
            EOT;
        }

        return "<tr>" . $headerElements . "</tr>";
    }

    // Tạo ra một dòng trong bảng
    // - param: một mảng các field
    // - return: chuỗi html của dòng
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

    // Tạo ra các dòng trong bảng
    // - param (optional): các column bổ sung.
    // - return: chuỗi html của các dòng
    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);

            // Thêm các column truyền vào nếu có
            foreach (func_get_args() as $column)
                $entryElement .= $column;

            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    // Lấy danh sách loại để cho vào select box:
    protected function getTypes()
    {
        $uri = API_ROOT . 'src/BLL/v1/GET/CustomerTypeList.php';
        $Types = fetchAPI($uri);

        $entries = [];
        foreach ($Types as $index => $Type) {
            $entries[] = [
                ["value" => $index + 1],
            ];
        }
        return $entries;
    }

    // tạo options PK từ ds loại
    protected function makeTypeOptions()
    {
        $Types = $this->getTypes();
        $options = array_map(function ($Type) {
            return $Type[1]['value'];
        }, $Types);
        return $options;
    }

    protected function makeSelectBox($options, $currentValue)
    {
        $optionsElement = "";
        foreach ($options as $option) {
            $selected = $currentValue == $option ? "selected" : "";
            $optionsElement .= "<option value='$option' $selected>$option</option>";
        }
        return "<select>$optionsElement</select>";
    }

    // Tạo ra một dòng cho phép chỉnh sửa trong bảng
    // - param (optional): các fields cần hiển thị
    // - return: chuỗi html của dòng chỉnh sửa
    protected function renderSampleEntry($fields = [])
    {
        $sampleEntryElement = "<div class='sample-entry'>";

        foreach ($fields as $title => $name) {
            $sampleEntryElement .= <<< EOT
                <div>
                    <label for="$name">$title</label>
                    <input type="text" name="$name" id="$name"></input>
                </div>
            EOT;
        }

        return $sampleEntryElement . '</div>';
    }

    // Tạo ra các nút thao tác trong bảng
    // - return: chuỗi html của các nút thao tác
    protected function renderButtons()
    {
        $buttonsElement = "<div class='table-buttons'>";

        foreach ($this->buttons as $button) {
            $text = $button['text'] ?? '';
            $handler = $button['handler'] ?? '';

            $buttonsElement .= <<<EOT
                <button 
                type="button"
                onclick="$handler"
                >
                    $text
                </button>
            EOT;
        }
        return $buttonsElement . "</div>";
    }
}

abstract class FormComponent extends Component
{
    public function __construct($props = [])
    {
        foreach ($props as $key => $value) {
            $this->$key = $value ?? "";
        }
    }

    protected function renderInputClasses($group)
    {
        $classes = '';
        if (isset($group["classes"])) {
            foreach ($group["classes"] as $class) {
                $classes .= $class . " ";
            }
        }
        return $classes;
    }

    protected function renderGroups()
    {
        $groupElements = '';

        foreach ($this->groups as $group) {
            if (!isset($group['placeholder'])) $group['placeholder'] = '';
            if (!isset($group['text'])) $group['text'] = '';

            $inputClasses = $this->renderInputClasses($group);

            $groupElements .= <<< EOT
            <label 
                for="{$group['id']}" 
                class="form-label"
            >
                {$group['label']}
            </label>

            <input 
                class="form-control $inputClasses" 
                placeholder="{$group['placeholder']}"
                name="{$group['name']}" 
                id="{$group['id']}" 
                type="{$group['type']}"
            />

            <p class="form-text">
                {$group['text']}
            </p>
            EOT;
        }

        return $groupElements;
    }
}
