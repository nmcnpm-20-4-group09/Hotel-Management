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
            $entryElement .= <<< EOT
                <td>$value</td>
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

    protected function addColumn($field)
    {
        if (!in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }
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
