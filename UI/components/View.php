<?php
// Paths
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("COMPONENT_PATH", ROOT . "/UI/components/");
define("FORM_PATH", ROOT . "/UI/components/forms/");
define("VIEW_PATH", ROOT . "/UI/views/");


// View classes and functions
abstract class Component
{
    abstract public function render();
};

abstract class TableComponent
{
    abstract public function render();

    public function renderHeaders()
    {
        $headerElements = '';

        foreach ($this->fields as $field) {
            $headerElements .= <<<EOT
                <th scope="col">{$field}</th>
            EOT;
        }

        return "<tr>" . $headerElements . "</tr>";
    }

    public function renderFields($entry)
    {
        $entryElement = '';

        foreach ($entry as $field) {
            $entryElement .= <<<EOT
                <td>{$field}</td>
            EOT;
        }

        return $entryElement;
    }

    public function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderFields($entry);
            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
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