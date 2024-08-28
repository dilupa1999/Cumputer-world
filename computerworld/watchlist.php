<?php

require "connection.php";


?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Computerworld</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="animate.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body class=" container-fluid">

    <div class="container-fluid main-body">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["u"])) {

            ?>

                <hr />

                <div class="col-12">
                    <div class="row shadow-lg">
                        <div class="col-12 border border-1 border-primary rounded mb-2">
                            <div class="row">

                                <div class="col-12 text-center mt-1 shadow-lg bg-light animate__animated animate__lightSpeedInLeft">
                                    <label class="form-label fs-1 fw-bold">Your Favourites &hearts;</label>
                                </div>







                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-11 col-lg-2 border-0 border-end border-1 border-primary border shadow-lg rounded m-2 animate__animated animate__lightSpeedInLeft" style="background-color: #E9EBEE;" >

                                    <nav class="nav nav-pills flex-column mt-5 ">

                                        <a class="nav-link active  fw-bold" aria-current="page" href="#">My Watchlist</a>
                                        <a class="nav-link fw-bold  " href="home.php">Home</a>
                                        <a class="nav-link fw-bold" href="cart.php">My Cart</a>

                                    </nav>
                                </div>

                                <?php

                                $user = $_SESSION["u"]["email"];

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $user . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num == 0) {

                                ?>

                                    <!-- empty view -->

                                    <div class="col-12 col-lg-9 ">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-outline-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- empty view -->

                                <?php

                                } else {

                                ?>

                                    <div class="col-12 col-lg-9 animate__animated animate__slideInRight">
                                        <div class="row gap-lg-5 ms-lg-5">

                                            <?php

                                            for ($x = 0; $x < $watch_num; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $watch_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $product_data["user_email"] . "'");
                                                $seller_data = $seller_rs->fetch_assoc();

                                            ?>

                                                <!-- have Products -->

                                                <div class="card mb-3 mx-0 col-12 mx-lg-0 shadow-lg">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 d-flex align-items-center justify-content-center shadow-lg">

                                                            <?php

                                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "'");
                                                            $image_data = $image_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-1 img-fluid rounded-start" style="height: 150px; width: auto;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $product_data["title"]; ?></h5>

                                                                <?php

                                                                $colour_rs = Database::search("SELECT * FROM `colour` WHERE `id` = '" . $product_data["colour_id"] . "'");
                                                                $colour_data = $colour_rs->fetch_assoc();

                                                                $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $product_data["condition_id"] . "'");
                                                                $condition_data = $condition_rs->fetch_assoc();

                                                                ?>

                                                                <span class="fs-5 fw-bold text-black-50">Colour : <?php echo $colour_data["name"]; ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black-50">Condition : <?php echo $condition_data["name"]; ?></span><br />
                                                                <span class="fs-5 fw-bold text-black-50">Price : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                                                <span class="fs-5 fw-bold text-black-50">Seller : </span><br />
                                                                <span class="fs-5 fw-bold text-black"><?php echo $seller_data["fname"]; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                                <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                                                                <a href="#" class="btn btn-outline-danger mt-2" onclick='removeFromWatchlist(<?php echo $watch_data["id"] ?>);'>Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- have Products -->

                                            <?php

                                            }

                                            ?>

                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                echo ("Please Login First");
            }

            ?>


            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>