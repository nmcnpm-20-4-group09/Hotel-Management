<?php include "../components/header.php"; ?>

<body>
    <div class="container">

        <?php require $componentPath . 'sidebar.php'; ?>

        <div class="main">

            <?php include $componentPath . 'heading.php'; ?>

            <div class="feature">
                <?php include $componentPath . 'months.php'; ?>
            </div>
        </div>
    </div>

    <?php include $componentPath . 'script.php'; ?>
    <script>
        updateFeature('report')
        handleEvents()
    </script>

</body>

</html>