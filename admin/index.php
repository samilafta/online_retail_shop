<?php
session_start();
require_once "../dbfunctions/db.php";

if (!isset($_SESSION['admin']))   {
    redirect("login.php");
    exit();
}

$sql = "SELECT COUNT(*) AS `count` FROM `items`";
$result = dbconnect()->query($sql);
$row = $result->fetch_assoc();
$countItems = $row['count'];

$sql = "SELECT COUNT(*) AS `count` FROM `users`";
$result1 = dbconnect()->query($sql);
$row = $result1->fetch_assoc();
$countUsers = $row['count'];

$sql = "SELECT COUNT(*) AS `count` FROM `sales`";
$result2 = dbconnect()->query($sql);
$row = $result2->fetch_assoc();
$countSales = $row['count'];

$sql = "SELECT COUNT(*) AS `count` FROM `category`";
$result3 = dbconnect()->query($sql);
$row = $result3->fetch_assoc();
$countCat = $row['count'];


?>


<?php include "includes/header.php" ?>

<!-- Counts Section -->
<section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="icon-user"></i></div>
                    <div class="name"><strong class="text-uppercase">Clients</strong>
                        <div class="count-number"><?php echo $countUsers ?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="icon-padnote"></i></div>
                    <div class="name"><strong class="text-uppercase">Orders</strong>
                        <div class="count-number"><?php echo $countSales ?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="icon-check"></i></div>
                    <div class="name"><strong class="text-uppercase">Shopping Items</strong>
                        <div class="count-number"><?php echo $countItems ?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="icon-bill"></i></div>
                    <div class="name"><strong class="text-uppercase">Item Categories</strong>
                        <div class="count-number"><?php echo $countCat ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h2 class="h2 display">Orders</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Code</h3></th>
                            <th><h3>Name</h3></th>
                            <th><h3>Phone #</h3></th>
                            <th><h3>Address</h3></th>
                            <th><h3>Status</h3></th>
                            <th><h3>Total GH¢</h3></th>
                            <th><h3>Date</h3></th>
                            <th><h3>Action</h3></th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        $sql = "SELECT * FROM sales ORDER BY salesID DESC";
                        $result = dbconnect()->query($sql);
                        if ($result->num_rows == 0) {
                            echo "<h3>No Orders</h3>";
                        }   else {
                            $i = 1;
                            while ($row = $result->fetch_array()) {
                                ?>
                                <tr>
                                    <td><h5><?php echo $i; ?></h5></td>
                                    <td><h5><?php echo $row['salesCode']; ?></h5></td>
                                    <td><h5><?php echo $row['full_name']; ?></h5></td>
                                    <td><h5><?php echo $row['tel_num']; ?></h5></td>
                                    <td><h5><?php echo $row['address']; ?></h5></td>
                                    <td><h5><?php
                                            if ($row['status'] === "not paid") {
                                                echo "<span class='badge badge-danger'>" . $row['status'] . "</span>";
                                            } else {
                                                echo "<span class='badge badge-success'>" . $row['status'] . "</span>";
                                            }

                                            ?></h5>
                                    </td>
                                    <td><h5>¢<?php echo $row['totalAmount']; ?></h5></td>
                                    <td><h5><?php echo $row['sales_date']; ?></h5></td>
                                    <td>
                                        <button class="btn btn-success" data-toggle="modal"
                                           data-target="#detailModal<?php echo $row['salesID']; ?>">
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                        <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#confirmModal<?php echo $row['salesID']; ?>">
                                            <i class="fa fa-dollar"></i>
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal<?php echo $row['salesID']; ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </button>

                                        <!--details modal -->
                                        <div class="modal fade" id="detailModal<?php echo $row['salesID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-danger" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Order Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
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
                                                        <button class="btn btn-primary" name="confirm">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--details modal -->

                                    </td>

                                    <!-- confirm money modal -->
                                    <div class="modal fade" id="confirmModal<?php echo $row['salesID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Confirm payment of Sales Code <b><?php echo $row['salesCode']; ?></b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form class="style-form" action="modal-validations/confirm.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $row['salesID']; ?>"/>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-primary" name="confirm">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- confirm money modal -->

                                    <!-- delete modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $row['salesID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Sale </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete <b><?php echo $row['salesCode']; ?></b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form class="style-form" action="modal-validations/deletesale.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $row['salesID']; ?>"/>
                                                        <input type="hidden" name="code" value="<?php echo $row['salesCode']; ?>"/>

                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-primary" name="delsale">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /delete modal -->


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
</div>


<?php include "includes/footer.php" ?>
