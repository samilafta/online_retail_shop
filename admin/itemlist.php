<?php
session_start();
require_once "../dbfunctions/db.php";

if (!isset($_SESSION['admin']))   {
    redirect("login.php");
    exit();
}

?>

<?php include "includes/header.php" ?>

    <!-- breadcrumb navigation -->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Item List</li>
            </ul>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h2 display">List of Items</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Price GH¢</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $sql = "SELECT * FROM `items` ORDER BY itemID DESC ";
                            $result = dbconnect()->query($sql);
                            $i = 1;
                            while ($row = $result->fetch_array()) {
                            $id = $row['itemID'];
                            $iname = $row['itemName'];
                            $image = $row['itemImage'];
                            $icat = $row['itemCategory'];
                            $iprice = $row['itemPrice'];
                            $idate = $row['dateAdded'];
                            ?>

                                <tr>
                                    <td scope="row"><?php echo $i; ?></td>
                                    <td><?php echo $iname ?></td>
                                    <td><?php echo $icat; ?></td>
                                    <td><?php echo $iprice ?></td>
                                    <td><?php echo $idate ?></td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal"
                                           data-target="#editModal<?php echo $id; ?>">
                                            <i class="fa fa-edit "></i>
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal"
                                           data-target="#deleteModal<?php echo $id; ?>">
                                            <i class="fa fa-trash-o "></i>
                                        </button>
                                    </td>

                                    <!-- edit modal -->
                                    <div class="modal fade" id="editModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-primary" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Item</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="style-form" action="modal-validations/editItem.php" method="post">
                                                        <div class="form-group">
                                                            <label for="name">Item Name</label>
                                                            <input type="hidden" id="name" class="form-control" name="id" value="<?php echo $id; ?>"/>
                                                            <input id="name" class="form-control" name="name" value="<?php echo $iname; ?>" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Price GH¢</label>
                                                            <input id="price" class="form-control" name="price" pattern="\d{0,10}\.?\d{0,2}" title="eg. 55.00" value="<?php echo $iprice; ?>" required/></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-primary" name="itemedit"></i>Confirm Changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- /edit modal -->

                                    <!-- delete modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-danger" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Item</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete <b><?php echo $iname; ?></b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form class="style-form" action="modal-validations/deleteitem.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                                        <input type="hidden" name="name" value="<?php echo $iname; ?>"/>

                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-primary" name="itemdelete">Confirm Delete</button>
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
