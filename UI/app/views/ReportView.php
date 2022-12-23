<?php

namespace App\Views;

use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Months;

class ReportView
{
    public function __construct($props = [])
    {
        $this->props = $props;
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header());
        $months = View::render(new Months());

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $months
                    </div>
                </div>
            </div>

            <script>
                handleEvents()
                updateFeature('report')
            </script>
            </body>
        </html>
        EOT;

        return $view;
    }
}
