<?php
require "../components/View.php";
require_once(COMPONENT_PATH . "Sidebar.php");
?>

<body>
    <div class="container">
        <?php
        $sidebar = new Sidebar();
        echo $sidebar->render();
        ?>

        <div class="main">
        

            <div class="feature">

            </div>
        </div>
    </div>

</body>

</html>