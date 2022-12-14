<?php
require_once("../Preset.php");
require_once(COMPONENT_PATH . "Sidebar.php");
require_once(COMPONENT_PATH . "Header.php");
require_once(FORM_PATH . "SignInForm.php");
require_once(FORM_PATH . "SignUpForm.php");
require_once(FORM_PATH . "RevenueReportForm.php");
require_once(FORM_PATH . "RoomReportForm.php");
?>

<body>
    <div class="container">
        <?php View::render(new RoomReportForm()); ?>
    </div>
</body>

</html>