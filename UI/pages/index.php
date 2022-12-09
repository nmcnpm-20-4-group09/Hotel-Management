<?php include "../components/preset.php"; ?>

<body>
    <div class="container">

        <?php require $componentPath . 'sidebar.php'; ?>

        <div class="main">

            <?php include $componentPath . 'header.php'; ?>

            <div class="feature">
                <?php include $componentPath . 'overview.php'; ?>
                <?php include $componentPath . 'recent_orders.php'; ?>
            </div>
        </div>
    </div>

    <?php include $componentPath . 'script.php'; ?>
</body>

</html>