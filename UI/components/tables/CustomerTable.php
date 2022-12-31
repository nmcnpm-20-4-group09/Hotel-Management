<?php
namespace Components\Tables;
use Components\TableComponent;

class CustomerTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);

        $this->fields = [
            'STT',
            'Mã khách',
            'Loại khách',
            'Họ và tên',
            'SĐT',
            'CMND',
            'Chi tiết'
        ];
    }

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