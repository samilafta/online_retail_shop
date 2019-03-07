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
                <li class="breadcrumb-item active">Shopping Items</li>
                <li class="breadcrumb-item active">Item List</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h2 display">List of Customers</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Telephone #</th>
                                <th>Date Registered</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM `users` ORDER BY userID DESC ";
                            $result = dbconnect()->query($sql);
                            $i = 1;
                            while ($row = $result->fetch_array()) {
                            ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['tel_num']; ?></td>
                                <td><?php echo $row['date_reg']; ?></td>
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
