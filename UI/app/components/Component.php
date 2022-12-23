<?php

namespace App\Components;

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

    protected function renderSelect($options)
    {
        $field = "<select data-menu>";
        $options = explode("|", $options);

        foreach ($options as $option) {
            $field .= <<<EOT
                <option>{$option}</option>
            EOT;
        }

        return $field .= "</select>";
    }

    protected function renderEntry($entry)
    {
        $entryElement = "";

        foreach ($entry as $field) {
            $value = $field['value'] ?? '';
            $editable = "";

            // Render select box nếu dữ liệu có dạng a|b|c
            if (strpos($value, "|")) {
                $value = $this->renderSelect($value);
            }

            // Thêm thuộc tính editable cho field
            if (array_key_exists('editable', $field))
                $editable = "contenteditable='true'";

            $entryElement .= <<< EOT
                <td $editable>$value</td>
            EOT;
        }

        return $entryElement;
    }

    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);
            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
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
