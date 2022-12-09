<?php include "../components/preset.php"; ?>

<body>
    <div class="container">

        <?php
        include $formPath . 'signin.php';
        include $formPath . 'signup.php';
        include $formPath . 'reports.php';
        ?>

    </div>

    <?php include $componentPath . 'script.php' ?>
    <script>
        renderForm('report-form')
    </script>
</body>

</html>