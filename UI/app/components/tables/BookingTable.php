<?php
namespace App\Components\Tables;
use App\Components\TableComponent;

class BookingTable extends TableComponent
{
    public function __construct()
    {
        $this->fields = [
            'STT',
            'KHÁCH HÀNG',
            'LOẠI KHÁCH',
            'CMND',
            'ĐỊA CHỈ',
        ];
        $this->entries = [
            [
                '1',
                'Đặng Võ Hoàng Kim Tuyền',
                'Khách thường',
                '123456789012',
                'Thành phố Hồ Chí Minh',
            ],
            [
                '1',
                'Đặng Võ Hoàng Kim Tuyền',
                'Khách thường',
                '123456789012',
                'Thành phố Hồ Chí Minh',
            ],
            [
                '1',
                'Đặng Võ Hoàng Kim Tuyền',
                'Khách thường',
                '123456789012',
                'Thành phố Hồ Chí Minh',
            ],
        ];
    }

    public function render()
    {
        $fieldElements = $this->renderFields();
        $entryElements = $this->renderEntries();

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
        </div>
        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Table.css">
