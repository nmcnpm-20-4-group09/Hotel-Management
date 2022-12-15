<?php
include_once COMPONENT_PATH . "Sidebar.php";
include_once COMPONENT_PATH . "Header.php";
include_once TABLE_PATH . "BookingTable.php";
include_once COMPONENT_PATH . "Toolbar.php";
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