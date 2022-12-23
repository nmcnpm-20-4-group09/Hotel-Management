<?php

namespace App\Views;

use App\Components\View;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Overview;
use App\Components\Tables\RecentOrdersTable;
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()); ?>

        <div class="main">
            <?php View::render(new Header(['title' => "Trang chủ"])); ?>

            <div class="index">
                <?php View::render(new Overview()); ?>
                <?php View::render(new RecentOrdersTable()); ?>
            </div>
        </div>
    </div>

    <script>
        handleEvents()
        updateFeature()
    </script>
</body>

</html>