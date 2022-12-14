<?php
require_once("../Preset.php");
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(COMPONENT_PATH . "Overview.php");
require_once(TABLE_PATH . "RecentOrdersTable.php");
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()); ?>

        <div class="main">
            <?php View::render(new Header()); ?>

            <div class="index">
                <?php View::render(new Overview()); ?>
                <?php View::render(new RecentOrdersTable()); ?>

            </div>
        </div>
    </div>
    
    <script>
        handleEvents()
    </script>
</body>

</html>