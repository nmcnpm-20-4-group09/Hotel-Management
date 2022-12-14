<?php
require_once("../components/View.php");
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(TABLE_PATH . "BookingTable.php");
require_once(COMPONENT_PATH . "Toolbar.php");
?>

<body>
    <div class="container">

        <?php View::render(new Sidebar()) ?>


        <div class="main">
            <header class="header">
                <h1>CHI TIẾT THUÊ</h1>
                <h1>PHÒNG 1403</h1>
                <h1>Ngày bắt đầu thuê: 10/10/2020</h1>
            </header>

            <div class="feature">
                <?php View::render(new BookingTable()) ?>
                <?php View::render(new Toolbar()) ?>
            </div>
        </div>
    </div>
</body>

</html>