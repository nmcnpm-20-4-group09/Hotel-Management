<link rel="stylesheet" href="../css/layout.css" />

<?php include '../components/header.php'; ?>

<body>
    <div class="container">

        <?php
        include "../components/globals.php";
        global $activedForm;
        
        if ($activedForm == Form::SIGNIN)
            include '../components/signin.php';
        elseif ($activedForm == Form::SIGNUP)
            include '../components/signup.php';
        else
            echo "Error: Invalid form";
        ?>

    </div>
</body>

</html>
