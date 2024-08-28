<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];
    $pageno;

?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>My Products | Computerworld</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="animate.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

        <link rel="icon" href="resource/logo.svg" />
    </head>

    <body class="bg-primary  container-fluid" style="background-color: #E9EBEE;">



        <div class="container-fluid">
            <div class="row">

                <!-- header -->

                <div class="col-12  border shadow p-3 mb-2 mt-2 shadow-lg rounded " style="background-color:#74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1 text-center animate__animated animate__rollIn ">
                                    <?php

                                    $profile_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $email . "'");
                                    $profile_image_num = $profile_image_rs->num_rows;
                                    $profile_image_data = $profile_image_rs->fetch_assoc();

                                    if ($profile_image_num == 1) {

                                    ?>

                                        <img src="<?php echo $profile_image_data["path"]; ?>" width="90px" height="100px" class="rounded-circle" />

                                    <?php
                                    } else {

                                    ?>

                                        <img src="resource/new_user.svg" width="90px" height="100px" class="rounded-circle" />

                                    <?php

                                    }

                                    ?>

                                </div>
                                <div class="col-12 col-lg-6 animate__animated animate__rollIn">
                                    <div class="row text-center text-lg-start">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="text-white fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 ">
                            <div class="row">
                                <div class="col-12 col-lg-9 mt-2 my-lg-4">
                                    <h1 class="offset-4 offset-lg-2 text-white fw-bold animate__animated animate__fadeInRightBig">My Products</h1>
                                </div>
                                <div class="col-12 col-lg-3 mt-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid mb-3 dropdown shadow-lg rounded animate__animated animate__rollIn">
                                    <button class="btn btn-light dropdown-toggle bg-info " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        ComputerWorld
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                                        <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                                        <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                        <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                                        <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                        

                                        
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- header -->

                <!-- body -->

                <div class="col-12">
                    <div class="row">

                        <!-- filter -->

                        <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded main-body pbox1">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s" />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-success fw-bold" onclick="sort1(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="(window.location.reload())">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12  mt-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                            <button class="btn btn-warning fw-bold" onclick="window.location = 'addProduct.php'">Add Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- filter -->

                        <!-- product -->

                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white main-body rounded shadow-lg ">
                            <div class="row p-0" id="sort">
                                <div class="offset-1 rounded shadow-lg col-10 text-center p-1   ">
                                    <div class="row justify-content-center border-start shadow-lg ">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $email . "'");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $email . "'
                                        LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>

                                            <!-- card -->

                                            <div class="card mb-3 mt-3 col-12 col-lg-6 animate__animated animate__rollIn">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">
                                                        <?php

                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $selected_data["id"] . "'");
                                                        $product_img_data = $product_img_rs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">

                                                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="changeStatus(<?php echo $selected_data['id']; ?>);" <?php

                                                                                                                                                                                                            if ($selected_data["status_id"] == 1) {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }

                                                                                                                                                                                                            ?> />
                                                                <label class="form-check-label text-info fw-bold" for="flexSwitchCheckChecked" id="checklLable<?php echo $selected_data['id']; ?>">
                                                                    <?php

                                                                    if ($selected_data["status_id"] == 2) {
                                                                        echo "Make Your product Active.";
                                                                    } else {
                                                                        echo "Make Your product De-Active";
                                                                    }

                                                                    ?>
                                                                            </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row g-1">
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a onclick="sendId(<?php echo $selected_data['id']; ?>);" class="btn btn-success fw-bold">Update</a>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <button class="btn btn-danger fw-bold">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- card -->


                                        <?php
                                        }

                                        ?>


                                    </div>
                                </div>

                                <hr class=" shadow-lg mt-1">

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

                            </div>
                        </div>

                        <!-- product -->

                    </div>
                </div>

                <!-- body -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php

} else {

    header("Location:home.php");
}

?>