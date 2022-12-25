<?php

namespace App\Views;

use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Toolbar;


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

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
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
