<?php
namespace Views;

use Components\Sidebar;
use Components\Header;
use Components\Toolbar;
use Components\Tables\BookingTable;

class BookingView
{
    public function __construct($props)
    {
        $this->props = $props;
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header(['title' => "Chi tiết thuê phòng"]));
        $bookingTable = View::render(new BookingTable($this->props));
        $toolbar = View::render(new Toolbar($this->props));

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $bookingTable
                        $toolbar
                    </div>
                </div>
            </div>

            <script>
                handleEvents()
                updateFeature('booking')
            </script>
            </body>
        </html>
        EOT;

        return $view;
    }
}
