<?php
include_once COMPONENT_PATH . "Sidebar.php";
include_once COMPONENT_PATH . "Header.php";
include_once TABLE_PATH . "RoomTable.php";
include_once COMPONENT_PATH . "Toolbar.php";
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

    <script>
        handleEvents()
        updateFeature('room')
    </script>
</body>

</html>