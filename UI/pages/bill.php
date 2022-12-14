<?php include "../components/preset.php"; ?>

<body>
    <div class="container">

        <?php require $componentPath . 'sidebar.php'; ?>

        <div class="main">

            <?php include $componentPath . 'header.php'; ?>

            <div class="feature">
                <?php include $componentPath . 'toolbar.php'; ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <?php include $componentPath . 'script.php'; ?>
    <script>
        updateFeature('bill')
        handleEvents()
    </script>

</body>

</html>