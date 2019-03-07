
<!DOCTYPE HTML>
<html>
<head>
    <title>Jamin Shop an Online Retail Shop for Clothes and Electronics | Home </title>
    <!--css-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <!--css-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script src="js/jquery.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Cagliostro' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
    <!--search jQuery-->
    <script src="js/main.js"></script>
    <!--search jQuery-->
    <script src="js/responsiveslides.min.js"></script>
    <script>
        $(function () {
            $("#slider").responsiveSlides({
                auto: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                pager: true,
            });
        });
    </script>
    <!--mycart-->
    <script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
    <!-- cart -->
    <script src="js/simpleCart.min.js"></script>
    <!-- cart -->
    <!--start-rate-->
    <script src="js/jstarbox.js"></script>
    <link rel="stylesheet" href="css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
    <script type="text/javascript">
        jQuery(function() {
            jQuery('.starbox').each(function() {
                var starbox = jQuery(this);
                starbox.starbox({
                    average: starbox.attr('data-start-value'),
                    changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
                    ghosting: starbox.hasClass('ghosting'),
                    autoUpdateAverage: starbox.hasClass('autoupdate'),
                    buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
                    stars: starbox.attr('data-star-count') || 5
                }).bind('starbox-value-changed', function(event, value) {
                    if(starbox.hasClass('random')) {
                        var val = Math.random();
                        starbox.next().text(' '+val);
                        return val;
                    }
                })
            });
        });
    </script>
    <!--//End-rate-->
</head>
<body>
<!--header-->
<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="top-left">
                <a href="#"> Help  <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +233 027-564-4580</a>
            </div>
            <div class="top-right">
                <ul>
                    <li><a href="checkout.php">Checkout</a></li>
                    <?php
                        if (isset($_SESSION['username'])) {
                            ?> <li><a href="logout.php">Logout</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php"> Create Account </a></li>
                            <?php
                        }
                    ?>
                    </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="heder-bottom">
        <div class="container">
            <div class="logo-nav">
                <div class="logo-nav-left">
                    <h1><a href="index.php">Jamin Shop <span>Shop anywhere</span></a></h1>
                </div>
                <div class="logo-nav-left1">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header nav_2">
                            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="index.php" class="act">Home</a></li>
                                <li><a href="products.php">Shop</a></li>
                                <?php
                                if (isset($_SESSION['username'])) {
                                ?>
                                    <li><a href="orders.php">Orders</a></li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="header-right2">
                    <div class="cart box_1">
                        <a href="checkout.php">
                            <?php
                            if (!isset($_SESSION['code'])) {
                                $_SESSION['code'] = code(6);
                            }
                            $code = $_SESSION['code'];
                            $sql = "SELECT count(cart.code) AS count FROM cart WHERE cart.code = '$code'";
                            $result = dbconnect()->query($sql);
                            $fetch = $result->fetch_array();
                            $sql1 = "SELECT SUM(cart.total) AS `totall` FROM `cart` WHERE code = '$code'";
                            $run = dbconnect()->query($sql1);
                            $row = $run->fetch_array();
                            ?>
                            <h3> <div class="total">
                                    ( ¢<?php echo $row['totall']; ?> )
                                    ( <?php echo $fetch['count']; ?> items)</div>
                                <img src="images/bag.png" alt="" />
                            </h3>
                        </a>
                        <p><a href="sys/cancel.php" class="simpleCart_empty">Empty Cart</a></p>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
<!--header-->

