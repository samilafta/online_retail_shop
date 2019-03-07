<?php
session_start();
require_once "../dbfunctions/db.php";

if (!isset($_SESSION['admin']))   {
    redirect("login.php");
    exit();
}


if (isset($_POST['report'])) {

    $from = $_POST['from'];
    $to = $_POST['to'];
    $food = $_POST['item'];

    redirect("report.php?from={$from}&to={$to}&item={$food}");

}

?>


<?php include "includes/header.php" ?>


    <!-- breadcrumb navigation -->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- generate report form -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h2 class="h2 display">Generate Report</h2>
                    </div>

                    <div class="card-body">
                        <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">From</label>
                                        <input id="from" class="form-control" name="from" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="2001-03-05" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price">To</label>
                                        <input id="to" class="form-control" name="to" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="2001-03-05" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="item">Item</label>
                                        <select id="item" name="item" class="form-control">
                                            <?php
                                            $sql = "SELECT items.itemName FROM items ORDER BY itemName";
                                            $result = dbconnect()->query($sql);
                                            while ($row = $result->fetch_array()) {
                                                $iname = $row['itemName'];
                                                ?>
                                                <option value="<?php echo $iname; ?>"><?php echo $iname; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Generate" name="report" class="mx-sm-3 btn btn-primary">
                                <input type="reset" value="Reset" class="mx-sm-3 btn btn-danger">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- report generation -->

    <?php
    if(isset($_GET['from']) && isset($_GET['from'])) {
    $f = $_GET['from'];
    $t = $_GET['to'];
    $item = $_GET['item'];
    ?>

        <div class="container-fluid" style="margin-top: 30px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h2 class="h2 display">Generated Report</h2><br/>
                        </div>
                        <div class="card-body">
                            <h4><?php echo "As at ". $f . " to ". $t; ?></h4>
                                <?php
                                $sql = "SELECT items.itemName FROM items ORDER BY itemName";
                                $result = dbconnect()->query($sql);

                                    $sql1 = "SELECT COALESCE(SUM(cart.qty), 0) AS `total qty`, COALESCE(SUM(cart.total), 0) AS `income`, itemName FROM cart
                                                        INNER JOIN items
                                                        ON cart.itemid = items.itemID
                                                        WHERE cart.date BETWEEN '$f' AND '$t' AND items.itemName = '$item'";
                                    $result1 = dbconnect()->query($sql1);
                                    $row1 = $result1->fetch_array();
                                        $totalQty = $row1['total qty'];
                                        $totalIncome = $row1['income'];
                                if ($totalQty === "0" && $totalIncome === "0.00") {
                                    echo "<tr>There are no sales made as at this date.</tr>";
                                }   else {
                                            ?>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Total Amount GH¢</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo $item ?></td>
                                            <td><?php echo $totalQty;  ?></td>
                                            <td><?php echo $totalIncome;  ?></td>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php } ?>


<?php include "includes/footer.php" ?>
