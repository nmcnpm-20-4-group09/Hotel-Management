<?php
namespace Views;

use Components\Sidebar;
use Components\Header;
use Components\Toolbar;
use Components\Tables\RoomTable;

class RoomView
{
    public function __construct(public $props = [])
    {
        $this->props = $props;
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header());
        $roomTable = View::render(new RoomTable($this->props));
        $toolbar = View::render(new Toolbar($this->props));

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $roomTable
                        $toolbar
                    </div>
                </div>
            </div>

            <script>
                handleEvents()
                updateFeature('room')
            </script>
            </body>
        </html>
        EOT;

        return $view;
    }
}
