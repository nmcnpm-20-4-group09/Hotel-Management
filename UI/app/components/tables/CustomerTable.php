<?php

namespace App\Components\Tables;

use App\Components\TableComponent;

class CustomerTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);
    }

    // Ghi đè phương thức của lớp cha
    public function renderFields()
    {
        $headerElements = '';
        $index = 0;

        foreach ($this->fields as $field) {
            // Ba field đầu có nút sort
            if ($index++ < 3) {
                $headerElements .= <<<EOT
                <th scope="col">
                    $field
                    <i class="fa-solid fa-sort"></i>
                </th>
                EOT;
            } else {
                $headerElements .= <<<EOT
                <th scope="col">$field</th>
                EOT;
            }
        }

        return "<tr>" . $headerElements . "</tr>";
    }

    // Ghi đè phương thức của lớp cha
    public function renderEntries()
    {
        $entryElements = '';

        foreach ($this->entries as $entry) {
            $entryElement = $this->renderEntry($entry);
            $entryElement .= '
            <td>
                <i class="fa-solid fa-circle-info"></i>
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