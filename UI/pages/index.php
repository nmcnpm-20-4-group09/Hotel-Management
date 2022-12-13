<?php
require "../components/View.php";
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(COMPONENT_PATH . "Overview.php");
require_once(COMPONENT_PATH . "RecentOrders.php");
?>

<body>
    <div class="container">
        <?php
        $sidebar = new Sidebar();
        echo $sidebar->render();
        ?>

        <div class="main">
            <?php
            $header = new Header();
            echo $header->render();
            ?>

            <div class="feature">
                <?php
                $overview = new Overview();
                echo $overview->render();

                $recentOrders = new RecentOrders();
                echo $recentOrders->render();
                ?>

            </div>
        </div>
    </div>

</body>

</html>