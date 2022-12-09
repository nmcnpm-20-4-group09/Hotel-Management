<?php include '../components/header.php'; ?>

<body>
    <div class="container">

        <?php require '../components/sidebar.php'; ?>

        <div class="main">

            <?php include '../components/heading.php'; ?>

            <div class="feature">
                <?php include '../components/overview.php'; ?>
                <?php include '../components/recent_orders.php'; ?>
            </div>
        </div>
    </div>

    <?php include '../components/script.php'; ?>
</body>

</html>

<!-- Styles -->
<link rel="stylesheet" href="../css/layout.css" />
<link rel="stylesheet" href="../css/index.css" />