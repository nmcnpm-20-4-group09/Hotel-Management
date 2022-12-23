<?php
namespace App\Views;

use App\Components\View;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\Toolbar;
use App\Components\Tables\CustomerTable;
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()) ?>

        <div class="main">
        <?php View::render(new Header()) ?>
        
        <div class="feature">
                <?php View::render(new CustomerTable()) ?>
                <?php View::render(new Toolbar()) ?>
            </div>
        </div>
    </div>

    <script>
        handleEvents()
        updateFeature('customer')
    </script>
</body>

</html>