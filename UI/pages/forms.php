<!-- Đây là trang layout mẫu -->
<?php include '../layouts/header.php'; ?>

<body>
    <div class="container">

        <?php
        include "../layouts/globals.php";
        global $activedForm;
        
        if ($activedForm == Form::SIGNIN)
            include '../components/signup.php';
        elseif ($activedForm == Form::SIGNUP)
            include '../components/signin.php';
        else
            echo "Error: Invalid form";
        ?>

    </div>
</body>

</html>

<link rel="stylesheet" href="../css/layout.css" />