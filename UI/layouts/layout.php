<!-- Đây là trang layout mẫu -->
<?php include './header.php'; ?>

<body>
    <div class="container">

        <?php require '../components/sidebar.php'; ?>

        <div class="main">

            <?php include '../components/heading.php'; ?>

            <div class="feature">
                <?php include '../components/feature.php'; ?>
                <?php include '../components/toolbar.php'; ?>
            </div>
        </div>
    </div>

    <?php include './script.php'; ?>
</body>

</html>

<link rel="stylesheet" href="../css/layout.css" />
