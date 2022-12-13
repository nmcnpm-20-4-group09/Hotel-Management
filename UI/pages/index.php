<?php
require_once("../components/View.php");
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(COMPONENT_PATH . "Overview.php");
require_once(COMPONENT_PATH . "RecentOrdersTable.php");
?>

<body>
    <div class="container">
        <?php render(new Sidebar()); ?>

        <div class="main">
            <?php render(new Header()); ?>

            <div class="feature">
                <?php render(new Overview()); ?>
                <?php render(new RecentOrdersTable()); ?>

            </div>
        </div>
    </div>

</body>

</html>