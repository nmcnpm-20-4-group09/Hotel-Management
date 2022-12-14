<?php
// Paths
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("COMPONENT_PATH", ROOT . "/UI/components/");
define("TABLE_PATH", COMPONENT_PATH . "/tables/");
define("FORM_PATH", COMPONENT_PATH . "/forms/");
define("VIEW_PATH", ROOT . "/UI/views/");


// View classes and functions
abstract class Component
{
    abstract public function render();
};

abstract class TableComponent extends Component
{
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

    protected function renderColumns($entry)
    {
        $entryElement = '';

        foreach ($entry as $field) {
            $entryElement .= <<<EOT
                <td>{$field}</td>
            EOT;
        }

        return $entryElement;
    }

    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderColumns($entry);
            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }
}

abstract class FormComponent extends Component
{
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
            <label for="{$group['id']}" class="form-label">{$group['label']}</label>
            <input  class="form-control $inputClasses" placeholder="{$group['placeholder']}"
            name="{$group['name']}" id="{$group['id']}" type="{$group['type']}"/>
            <p class="form-text">{$group['text']}</p>
            EOT;
        }

        return $groupElements;
    }
}

class View
{
    static function render($component)
    {
        echo $component->render();
    }

    static function renderView($viewName)
    {
        $viewPath = VIEW_PATH . $viewName . ".php";
        require_once($viewPath);
        $view = new $viewName();
        View::render($view);
    }
}
?>

<!-- Preset -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel management</title>

    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="https://img.icons8.com/fluency/96/null/5-star-hotel.png" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f31e1a0778.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="../css/layout.css" />
</head>