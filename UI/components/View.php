<?php

if (!defined("ROOT")) define("ROOT", $_SERVER['DOCUMENT_ROOT']);
if (!defined("COMPONENT_PATH")) define("COMPONENT_PATH", ROOT . "/UI/components/");
if (!defined("FORM_PATH")) define("FORM_PATH", ROOT . "/UI/components/forms/");

if (!class_exists('Component')) {

    abstract class Component
    {
        abstract public function render();
    };
}

if (!class_exists('TableComponent')) {
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
                    <td scope="row">{$field}</td>
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
}


?>

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