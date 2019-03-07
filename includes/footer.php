<!---footer--->
<div class="footer-w3l">
    <div class="container">
        <div class="footer-grids">
            <div class="col-md-3 footer-grid">
                <h4>About </h4>
                <p>Jamin Shop is an online retail shop where you can buy clothes, accessories, electronic etc. at an affordable price.</p>
                <div class="social-icon">
                    <a href="#"><i class="icon"></i></a>
                    <a href="#"><i class="icon1"></i></a>
                    <a href="#"><i class="icon2"></i></a>
                    <a href="#"><i class="icon3"></i></a>
                </div>
            </div>

            <?php
                if (!isset($_SESSION['username'])) {
                    ?>
                    <div class="col-md-3 footer-grid">
                        <h4>My Account</h4>
                        <ul>
                            <li><a href="checkout.php">Checkout</a></li>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php"> Create Account </a></li>
                        </ul>
                    </div>

                    <?php
                }
            ?>
            <div class="col-md-3 footer-grid">
                <h4>Information</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="orders.php">Orders</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-grid foot">
                <h4>Contacts</h4>
                <ul>
                    <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i><a href="#">Tema Community 5</a></li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i><a href="#">+233 027-564-4580</a></li>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:jayandy123@hotmail.com"> jayandy123@hotmail.com</a></li>

                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>

    </div>
</div>
<!---footer--->
<!--copy-->
<div class="copy-section">
    <div class="container">
        <div class="copy-left">
            <p>&copy; 2018 Jamin Shop . All rights reserved | Design by Jamin</p>
        </div>
        <div class="copy-right">
            <img src="images/mtn.jpg" alt=""/>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


<!--modals copy-->

<?php
$sql = "SELECT * FROM `items` ORDER BY itemID DESC";
$result = dbconnect()->query($sql);
while ($row = $result->fetch_array()) {
?>

<div class="modal fade" id="myModal<?php echo $row['itemID'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="news-gr">
                    <div class="col-md-5 new-grid1">
                        <img src="admin/uploads/<?php echo $row['itemImage'] ?>" class="img-responsive" alt="">
                    </div>
                    <div class="col-md-7 new-grid">
                        <h5><?php echo $row['itemName'] ?></h5>
                        <h6>Quick Overview</h6>
                        <span>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                        <div class="women">
                            <p ><em class="item_price"> ¢<?php echo $row['itemPrice'] ?> </em></p>
                            <form method="post" action="sys/cart.php">
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom: 20px;">
                                        <input type="number" name="qty" value="1" min="1" max="100" class="form-control"/>
                                        <input type="hidden" name="price" value="<?php echo $row['itemPrice'] ?>" class="form-control"/>
                                        <input type="hidden" name="id" value="<?php echo $row['itemID'] ?>" class="form-control"/>
                                        <input type="hidden" name="date" value="<?php echo date("Y-m-d") ?>"/>
                                    </div>
                                </div>
                                <div class="add">
                                    <button name="addtocart" class="btn btn-danger my-cart-btn my-cart-b">Add to Cart</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<?php  } ?>


</body>
</html>