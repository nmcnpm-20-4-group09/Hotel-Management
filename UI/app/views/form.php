<?php

namespace App\Views;

use App\Components\View;
use App\Components\Forms\SignInForm;
use App\Components\Forms\SignUpForm;
use App\Components\Forms\RevenueReportForm;
use App\Components\Forms\RoomReportForm;
?>

<body>
    <div class="container">
        <?php View::render(new SignUpForm()); ?>
    </div>
</body>

</html>