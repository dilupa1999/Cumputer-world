<?php

session_start();
require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | Computerworld</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="animate.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body class=" main-body container-fluid">

    <div class=" col-12 shadow-lg rounded">
        <?php
        require "adminheader.php";
        ?>

    </div>

    <div class="container-fluid">
        <div class="row">
            <hr>

            <div class="col-12 bg-light text-center shadow-lg rounded pbox">
                <label class="form-label text-primary fw-bold fs-1 animate__animated animate__fadeInLeft ">Manage All Users</label>
            </div>

            <hr>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary py-2 text-end shadow-lg rounded">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2  shadow-lg rounded">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-primary py-2  shadow-lg rounded">
                        <span class="fs-4 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2  shadow-lg rounded">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-primary py-2  shadow-lg rounded">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2  shadow-lg rounded">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 d-none d-lg-block bg-light py-2  shadow-lg rounded">
                        <span class="fs-4 fw-bold">Status</span>
                    </div>
                </div>
            </div>

            <?php

            $pageno;
            $query = "SELECT * FROM `user`";

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

            $results_per_page = 5;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {

                $selected_data = $selected_rs->fetch_assoc();






            ?>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary py-2 text-end  shadow-lg rounded">
                            <span class="fs-4 text-dark"><?php echo $x + 1; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2  shadow-lg rounded" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">

                            <?php

                            $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $selected_data["email"] . "'");
                            $profile_num = $profile_rs->num_rows;

                            if ($profile_num == 0) {

                            ?>

                                <img src="resource/profile_img/us.svg" style="height: 40px;margin-left: 80px;" />

                            <?php

                            } else {

                                $profile_data = $profile_rs->fetch_assoc();

                            ?>

                                <img src="<?php echo $profile_data["path"]; ?>" style="height: 40px;margin-left: 80px;" />

                            <?php

                            }

                            ?>


                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2  shadow-lg rounded">
                            <span class="fs-4 text-dark"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2  shadow-lg rounded">
                            <span class="fs-5"><?php echo $selected_data["email"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-primary py-2  shadow-lg rounded">
                            <span class="fs-4 text-dark"><?php echo $selected_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2  shadow-lg rounded">
                            <span class="fs-4"><?php echo $selected_data["joined_date"]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2 d-grid  shadow-lg rounded">

                            <?php

                            if ($selected_data["status"] == 1) {

                            ?>

                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>

                            <?php

                            } else {

                            ?>

                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>

                            <?php

                            }

                            ?>


                        </div>
                    </div>
                </div>

               

            <?php

            }

            ?>

            <!--  -->

            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="<?php if ($pageno <= 1) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($pageno - 1);
                                                        } ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {

                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php

                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }

                        ?>

                        <li class="page-item">
                            <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                            echo "#";
                                                        } else {
                                                            echo "?page=" . ($pageno + 1);
                                                        } ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--  -->

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>