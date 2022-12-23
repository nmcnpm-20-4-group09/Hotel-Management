<?php

namespace App\Components\Tables;

use App\Components\TableComponent;

class BookingTable extends TableComponent
{
    public function __construct($props = [])
    {
        $this->fields = $props['fields'] ?? [];
        $this->entries = $props['entries'] ?? [];
        $this->action = $props['action'] ?? '';
        $this->buttons = $props['buttons'] ?? [];
    }

    public function renderTableButtons()
    {
        $buttonsElement = '';

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

        return $buttonsElement;
    }

    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);

            // Thêm checkbox vào các dòng
            if ($this->action == "delete" || $this->action == "justify") {
                $entryElement .= "<td><input type='checkbox' class='checkbox'></td>";
            } else {
            }

            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();
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