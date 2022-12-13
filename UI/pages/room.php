<?php
require "../components/View.php";
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(COMPONENT_PATH . "RoomTable.php");
require_once(COMPONENT_PATH . "Toolbar.php");
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()) ?>

        <div class="main">
            <?php View::render(new Header()) ?>

            <div class="feature">
                <?php View::render(new RoomTable()) ?>
                <?php View::render(new Toolbar()) ?>
            </div>
        </div>
    </div>
</body>

</html>