<?php
session_start();
require_once "dbfunctions/db.php";
?>

<?php include "includes/header.php"; ?>

    <!--banner-->
    <div class="banner1">
        <div class="container">
            <h3><a href="index.php">Home</a> / <span>Orders</span></h3>
        </div>
    </div>
    <!--banner-->

    <div class="content">
        <!--contact-->
        <div class="mail-w3ls">
            <div class="container">
                <h2 class="tittle">Orders</h2>
                <div class="mail-grids">
                    <div class="mail-bottom">
                        <h4> Please use the code generated as reference number when paying for your order using MTN Mobile Money (+233 0557 484 362) </h4>
                    </div>
                    <div class="cart-header">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><h3>No.</h3></th>
                                <th><h3>Code</h3></th>
                                <th><h3>Address</h3></th>
                                <th><h3>Status</h3></th>
                                <th><h3>Total GH¢</h3></th>
                                <th><h3>Date</h3></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $userid = $_SESSION['user_id'];
                            $sql = "SELECT * FROM sales WHERE user_id = '$userid' ORDER BY salesID DESC";
                            $result = dbconnect()->query($sql);
                            if ($result->num_rows == 0) {
                                echo "<h3>No Orders</h3>";
                            }   else {
                                $i = 1;
                                while ($row = $result->fetch_array()) {
                                    ?>
                                    <tr>
                                        <td><h4><?php echo $i; ?></h4></td>
                                        <td><h4><?php echo $row['salesCode']; ?></h4></td>
                                        <td><h4><?php echo $row['address']; ?></h4></td>
                                        <td><h4><?php
                                            if ($row['status'] === "not paid") {
                                                echo "<span class='label label-danger'>" . $row['status'] . "</span>";
                                            } else {
                                                echo "<span class='label label-success'>" . $row['status'] . "</span>";
                                            }

                                                ?></h4>
                                        </td>
                                        <td><h4>¢<?php echo $row['totalAmount']; ?></h4></td>
                                        <td><h4><?php echo $row['sales_date']; ?></h4></td>
                                        <td>
                                            <a class="btn btn-success" data-toggle="modal"
                                               data-target="#detailModal<?php echo $row['salesID']; ?>">
                                                View Order
                                            </a>

                                            <!-- detail modal -->
                                            <div class="modal fade" id="detailModal<?php echo $row['salesID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-success" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h3 class="modal-title" style="text-align: center; margin: 10px 0; padding: 20px 0; border-bottom: dashed;">Order Details</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th><h4>Item</h4></th>
                                                                    <th><h4>Qty</h4></th>
                                                                    <th><h4>Total</h4></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <?php
                                                                $code =  $row['salesCode'];
                                                                $sql1 = "SELECT cart.cartID, cart.code, cart.itemid, items.itemName, items.itemImage, cart.qty, cart.total FROM cart
                                                                        JOIN items ON cart.itemid = items.itemID WHERE cart.code = '$code'";
                                                                $result1 = dbconnect()->query($sql1);

                                                                    while ($row1 = $result1->fetch_array())    {

                                                                        ?>
                                                                        <tr>
                                                                            <td><h3><?php echo $row1['itemName']; ?></h3></td>
                                                                            <td><h3><?php echo $row1['qty']; ?></h3></td>
                                                                            <td><h3>¢<?php echo $row1['total']; ?></h3></td>
                                                                        </tr>

                                                                        <!-- ending cart -->
                                                                    <?php }
                                                                    $sql2 = "SELECT SUM(cart.total) AS `totall` FROM `cart` WHERE code = '$code'";
                                                                    $run = dbconnect()->query($sql2);
                                                                    while ($result2 = $run->fetch_array()) {
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="2" align="right"><h3><b>Total</b></h3></td>
                                                                            <td><h3><b>¢<?php echo $result2['totall']; ?></b></h3></td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" style="text-align: center;">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /detail modal -->

                                        </td>


                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            $result->close();
                            ?>


                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        <!--contact-->
    </div>




<?php include "includes/footer.php"; ?>
