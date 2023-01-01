<?php
namespace Views;

use Components\Sidebar;
use Components\Header;
use Components\Toolbar;
use Components\Tables\BillTable;


class BillView
{
    public function __construct($props = [])
    {
        $this->props = $props;
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header());
        $toolbar = View::render(new Toolbar($this->props));
        $table = View::render(new BillTable($this->props));

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $table
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
