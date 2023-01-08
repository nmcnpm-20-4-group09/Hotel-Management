<?php
namespace Views;

use Components\Sidebar;
use Components\Header;
use Components\Toolbar;
use Components\Tables\BillDetailTable;


class BillDetailView
{
    public function __construct($props = [])
    {
        $this->props = $props;
        $this->SoHoaDon = $_GET['SoHoaDon'] ?? "";
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header(['title' => "Chi tiết hóa đơn $this->SoHoaDon"]));
        $toolbar = View::render(new Toolbar($this->props));
        $billDetailTable = View::render(new BillDetailTable($this->props));

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $billDetailTable
                        $toolbar
                    </div>
                </div>
            </div>

            <script>
                handleEvents()
                updateFeature('bill')
            </script>
            </body>
        </html>
        EOT;

        return $view;

    }
}
