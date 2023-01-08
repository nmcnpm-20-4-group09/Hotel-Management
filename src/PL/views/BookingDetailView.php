<?php
namespace Views;

use Components\Sidebar;
use Components\Header;
use Components\Toolbar;
use Components\Tables\BookingDetailTable;


class BookingDetailView
{
    public function __construct($props)
    {
        $this->props = $props;
        $this->roomID = $_GET['bookingID'] ?? "";
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header(['title' => "Chi tiết thuê phòng $this->roomID"]));
        $bookingDetailTable = View::render(new BookingDetailTable($this->props));
        $toolbar = View::render(new Toolbar($this->props));

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $bookingDetailTable
                        $toolbar
                    </div>
                </div>
            </div>

            <script>
                handleEvents()
            </script>
            </body>
        </html>
        EOT;

        return $view;
    }
}
