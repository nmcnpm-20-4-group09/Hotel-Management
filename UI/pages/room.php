<?php include "../components/header.php"; ?>

<body>
    <div class="container">

        <?php require $componentPath . 'sidebar.php'; ?>

        <div class="main">

            <?php include $componentPath . 'heading.php'; ?>

            <div class="feature">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">PHÒNG</th>
                                <th scope="col">LOẠI PHÒNG</th>
                                <th scope="col">ĐƠN GIÁ</th>
                                <th scope="col">TÌNH TRẠNG</th>
                                <th scope="col">CHI TIẾT THUÊ PHÒNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <td class="spacer"></td>
                            <tr>
                                <td scope="row">1</td>
                                <td>1403</td>
                                <td>A</td>
                                <td>150.000</td>
                                <td>Trống</td>
                                <td>
                                    <a href="./booking.php">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php include $componentPath . 'toolbar.php'; ?>
            </div>
        </div>
    </div>

    <?php include $componentPath . 'script.php'; ?>
    <script>
        updateFeature('room')
        handleEvents()
    </script>
</body>

</html>