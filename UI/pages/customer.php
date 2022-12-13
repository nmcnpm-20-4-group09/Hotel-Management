<?php
require "../components/View.php";
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(COMPONENT_PATH . "CustomerTable.php");
require_once(COMPONENT_PATH . "Toolbar.php");
?>

<body>
    <div class="container">
        <?php render(new Sidebar()) ?>

        <div class="main">
        <?php render(new Header()) ?>
        
        <div class="feature">
                <?php render(new CustomerTable()) ?>
                <?php render(new Toolbar()) ?>
            </div>
        </div>
    </div>
</body>

</html>