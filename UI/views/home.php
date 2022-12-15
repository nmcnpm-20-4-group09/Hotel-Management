<?php
include_once COMPONENT_PATH . "Sidebar.php";
include_once COMPONENT_PATH . "Header.php";
include_once COMPONENT_PATH . "Overview.php";
include_once TABLE_PATH . "RecentOrdersTable.php";
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
        updateFeature()
    </script>
</body>

</html>