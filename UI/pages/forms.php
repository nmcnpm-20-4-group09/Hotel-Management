<?php include "../components/header.php"; ?>

<body>
    <div class="container">

        <?php
        global $activedForm;

        if ($activedForm == Form::SIGNIN)
            include $componentPath . 'signin.php';
        elseif ($activedForm == Form::SIGNUP)
            include $componentPath . 'signup.php';
        else
            echo "Error: Invalid form";
        ?>

    </div>
</body>

</html>