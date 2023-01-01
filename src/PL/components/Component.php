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


    // TODO: use array reduce
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

            // Thêm các column truyền vào nếu có
            foreach (func_get_args() as $column)
                $entryElement .= $column;

            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    protected function renderSampleEntry()
    {
        $entryElement = "<div class='sample-entry'>";
        foreach ($this->fields as $index => $field) {
            if ($index < 1) continue;

            $entryElement .= <<< EOT
                <span contenteditable='true'>$field</span>
            EOT;
        }

        return $entryElement . '</div>';
    }

    protected function renderButtons()
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
