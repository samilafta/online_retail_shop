<?php
session_start();
include "dbfunctions/db.php";


?>
<?php include "includes/header.php"; ?>

<!--banner-->
<div class="banner1">
    <div class="container">
        <h3><a href="index.php">Home</a> / <span>Checkout</span></h3>
    </div>
</div>
<!--banner-->

<!--content-->
    <div class="content">
        <div class="cart-items">
            <div class="container">
                <?php

                $code = $_SESSION['code'];
                $sql = "SELECT count(cart.code) AS count FROM cart WHERE cart.code = '$code'";
                $result = dbconnect()->query($sql);
                $fetch = $result->fetch_array();
                ?>

                <h2>My Shopping Bag (<?php echo $fetch['count']; ?>)</h2>
                <div class="cart-header">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><h4>Item</h4></th>
                            <th><h4>Quantity</h4></th>
                            <th><h4>Total</h4></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <!-- starting cart -->
                    <?php
                    $code = $_SESSION['code'];
                    $sql = "SELECT cart.cartID, cart.code, cart.itemid, items.itemName, items.itemImage, cart.qty, cart.total FROM cart
                                    JOIN items ON cart.itemid = items.itemID WHERE cart.code = '$code'";
                    $result = dbconnect()->query($sql);

                    if ($result->num_rows == 0)   {
                        echo "<style>.orderButton {display: none;}</style>";
                        echo "<tr><td><h1>No items added to cart.</h1></td></tr>";
                    }   else    {
                    while ($row = $result->fetch_array())    {

                    ?>
                        <tr>
                            <td><h3><?php echo $row['itemName']; ?></h3></td>
                            <td><h3><?php echo $row['qty']; ?></h3></td>
                            <td><h3>¢<?php echo $row['total']; ?></h3></td>
                            <td>
                                <form method="post" action="sys/deleteitem.php">
                                    <input type="hidden" name="id" value="<?php echo $row['cartID']; ?>"/>
                                    <button class="btn btn-danger" name="deleteitem" title="click to delete">Delete</button>
                                </form>

                            </td>
                        </tr>

                        <!-- ending cart -->
                    <?php }
                        $sql = "SELECT SUM(cart.total) AS `totall` FROM `cart` WHERE code = '$code'";
                        $run = dbconnect()->query($sql);
                        while ($result = $run->fetch_array()) {
                            ?>
                            <tr>
                                <td colspan="2" align="right"><h3><b>Total</b></h3></td>
                                <td><h3><b>¢<?php echo $result['totall']; ?></b></h3></td></td>
                                <td></td>
                            </tr>
                            <?php
                        }


                    } ?>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-4">
                            <div class="col-md-4">
                                <div class="orderButton">
                                    <a href="sys/cancel.php" class="btn btn-danger btn-lg btn-block">Cancel</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="orderButton">
                                    <a href="makeorder.php" class="btn btn-success btn-lg btn-block">Make Order!</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- checkout -->
    </div>

<?php include "includes/footer.php"; ?>
