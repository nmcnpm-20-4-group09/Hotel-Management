<?php
namespace App\Views;

use App\Components\View;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Months;
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()) ?>

        <div class="main">
            <?php View::render(new Header()) ?>

            <div class="feature">
                <?php View::render(new Months()) ?>
            </div>
        </div>
    </div>
    
    <script>
        handleEvents()
        updateFeature('report')
    </script>
</body>

</html>