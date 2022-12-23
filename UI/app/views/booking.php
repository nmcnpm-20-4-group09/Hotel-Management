<?php
namespace App\Views;

use App\Components\View;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Toolbar;
use App\Components\Tables\BookingTable;
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()) ?>

        <div class="main">
            <?php View::render(new Header(["title" => 'Chi tiết phiếu thuê'])) ?>

            <div class="feature">
                <?php View::render(new BookingTable()) ?>
                <?php View::render(new Toolbar()) ?>
            </div>
        </div>
    </div>
</body>

</html>