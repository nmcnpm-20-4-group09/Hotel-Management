<?php

namespace App\Components\Tables;

use App\Components\TableComponent;

class RoomTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);
    }

    // Ghi đè phương thức của lớp cha
    public function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);
            $entryElement .= '
            <td>
                <a href="./room-booking">
                    <i class="fa-solid fa-circle-info"></i>
                </a>
            </td>';
            $entryElements .= "<tr>" . $entryElement . "</tr>";
        }

        return $entryElements;
    }

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();

        return <<<EOT

            <div class="table-wrapper">
                <table class="scrollable">
                    <thead>
                        $fieldElements
                    </thead>
                    <tbody>
                        $entryElements
                    </tbody>
                </table>
            </div>
            EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">