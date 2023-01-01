<?php
namespace Views;

use Components\Sidebar;
use Components\Header;
use Components\Months;

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
