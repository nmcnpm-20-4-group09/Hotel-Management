<?php
require_once("../components/View.php");
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(COMPONENT_PATH . "Months.php");
?>

<body>
    <div class="container">
        <?php View::render(new Sidebar()) ?>

        <div class="main">
            <?php View::render(new Header()) ?>

            <div class="feature">
                <?php View::render(new Months()) ?>
            </div>
        </div>
    </div>
</body>

</html>