<?php
namespace Components\Tables;
use Components\TableComponent;

class RoomTable extends TableComponent
{
    public function __construct($props = [])
    {
        parent::__construct($props);

        $this->fields = [
            'STT',
            'Phòng',
            'Loại phòng',
            'Đơn giá',
            'Tình trạng',
        ];
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