<?php include '../layouts/header.php'; ?>

<body>
    <div class="container">

        <?php require '../components/sidebar.php'; ?>

        <div class="main">

            <?php include '../components/heading.php'; ?>

            <div class="feature">
                <?php include '../components/months.php'; ?>
                <?php include '../components/toolbar.php'; ?>
            </div>
        </div>
    </div>

    <?php include '../layouts/script.php'; ?>
    <script>
        const roomListButton = sidebarButtons[3];
        roomListButton.classList.add('actived');

        const months = $$('.month')
        let activedMonth = 1
        months.forEach((month) => {
            month.addEventListener('click', () => {
                activedMonth = month.querySelector('p').innerText
                
            })
        })

        changeFeatureTitle()
    </script>

</body>

</html>

<!-- Styles -->
<link rel="stylesheet" href="../css/layout.css" />