<?php
session_start();
require_once "dbfunctions/db.php";
?>


<?php include "includes/header.php" ?>

    <!--banner-->
    <div class="banner1">
        <div class="container">
            <h3><a href="index.php">Home</a> / <span>Products</span></h3>
        </div>
    </div>
    <!--banner-->
    <!--content-->

    <?php
        if (isset($_GET['cat'])) {
            $cat = $_GET['cat'];?>
    <div class="content">
        <div class="products-agileinfo">
            <h2 class="tittle" style="text-transform: uppercase;"><?php echo $cat ?></h2>
            <div class="container">
                <div class="product-agileinfo-grids w3l">
                    <div class="col-md-3 product-agileinfo-grid">
                        <div class="categories">
                            <h3>Categories</h3>
                            <ul class="tree-list-pad">
                                <?php
                                $sql = "SELECT * FROM `category` ";
                                $result = dbconnect()->query($sql);
                                $i = 1;
                                while ($row = $result->fetch_array()) {
                                ?>
                                <li><a href="category.php?cat=<?php echo $row['catName']; ?>"><h4 style="text-transform: capitalize"><?php echo $row['catName'] ?></h4></a>
                                    <?php  }?>
                            </ul>
                        </div>

                        <div class="cat-img">
                            <img class="img-responsive " src="images/45.jpg" alt="">
                        </div>
                    </div>
                    <!-- end of left side bar -->

                    <!-- start of main products -->
                    <div class="col-md-9 product-agileinfon-grid1 w3l">

                        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav1 nav1-tabs left-tab" role="tablist">
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                        <div class="product-tab">

                                            <?php

                                            $sql = "SELECT * FROM `items` WHERE itemCategory = '$cat' ORDER BY itemID DESC";
                                            $result = dbconnect()->query($sql);
                                            while ($row = $result->fetch_array()) {
                                                ?>
                                                <!-- main products -->
                                                <div class="col-md-4 product-tab-grid simpleCart_shelfItem" style="margin-bottom: 30px;">
                                                    <div class="grid-arr">
                                                        <div  class="grid-arrival">
                                                            <figure>
                                                                <a href="#" class="new-gri" data-toggle="modal" data-target="#myModal<?php echo $row['itemID'] ?>">
                                                                    <div class="grid-img">
                                                                        <img  src="admin/uploads/<?php echo $row['itemImage'] ?>" class="img-responsive" alt="">
                                                                    </div>
                                                                    <div class="grid-img">
                                                                        <img  src="admin/uploads/<?php echo $row['itemImage'] ?>" class="img-responsive"  alt="">
                                                                    </div>
                                                                </a>
                                                            </figure>
                                                        </div>
                                                        <div class="women">
                                                            <h6><a href="#" data-toggle="modal" data-target="#myModal<?php echo $row['itemID'] ?>"><?php echo $row['itemName'] ?></a></h6>
                                                            <p><em class="item_price">¢<?php echo $row['itemPrice'] ?></em></p>
                                                            <form method="post" action="sys/cart.php">
                                                                <div class="row">
                                                                    <input type="hidden" name="qty" value="1"/>
                                                                    <input type="hidden" name="price" value="<?php echo $row['itemPrice'] ?>" class="form-control"/>
                                                                    <input type="hidden" name="id" value="<?php echo $row['itemID'] ?>" class="form-control"/>
                                                                    <input type="hidden" name="date" value="<?php echo date("Y-m-d") ?>"/>
                                                                </div>
                                                                <button name="addtocart" class="my-cart-b item_add">Add To Cart</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php  }  }?>

                                            <!-- /main products -->
                                            <div class="clearfix"></div>
                                        </div>


                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </div>
    <!--content-->


<?php include "includes/footer.php"; ?>