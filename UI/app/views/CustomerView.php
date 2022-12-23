<?php
namespace App\Views;

use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Toolbar;
use App\Components\Tables\CustomerTable;

class CustomerView
{
    public function __construct($props = [])
    {
        $this->props = $props;
    }

    public function render()
    {
        $sideBar =  View::render(new Sidebar());
        $header = View::render(new Header());
        $customerTable = View::render(new CustomerTable($this->props));
        $toolbar = View::render(new Toolbar($this->props));

        $view =  <<<EOT
        <body>
            <div class="container">
                $sideBar
                <div class="main">
                    $header

                    <div class="feature">
                        $customerTable
                        $toolbar
                    </div>
                </div>
            </div>

            <script>
                handleEvents()
                updateFeature('customer')
            </script>
            </body>
        </html>
        EOT;

        return $view;

    }
}
