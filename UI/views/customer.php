<?php
require_once("../Preset.php");
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(TABLE_PATH . "CustomerTable.php");
require_once(COMPONENT_PATH . "Toolbar.php");
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