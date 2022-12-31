<?php
namespace Components\Tables;
use Components\TableComponent;

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

    protected function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);

            // Thêm checkbox vào các dòng
            if ($this->action == "delete" || $this->action == "justify") {
                $entryElement .= "
                <td>
                    <label>
                        <input type='checkbox' class='checkbox'>
                        <span class='checkmark'></span> 
                    </label>
                </td>";
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