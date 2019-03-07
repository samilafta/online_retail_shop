<?php
session_start();
require "../dbfunctions/db.php";


if (!isset($_SESSION['admin']))   {
    redirect("login.php");
    exit();
}


if (isset($_POST['additem'])) {
    $name = validate($_POST['name']);
    $price = $_POST['price'];
    $category = $_POST['category'];


    $img = $_FILES['image']['name'];
    $imgLoc = $_FILES['image']['tmp_name'];
    $loc = "uploads/$img";
    move_uploaded_file($imgLoc, $loc);

    if(addMember($name, $price, $category, $img))    {
        redirect("additem.php?itemadded");
    }   else    {
        $error[] = "An Error occurred. Please try again.";
    }


}


if (isset($_POST['addcat'])) {
    $name = validate($_POST['catname']);

    if (addCategory($name) == true) {
        redirect("additem.php?catadded");
    } else {
        $error[] = "An Error occurred. Please try again.";
    }
}



?>



<?php include "includes/header.php" ?>

<!-- breadcrumb navigation -->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Add Item</li>
        </ul>
    </div>
</div>

<!-- add category form -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h2 class="h2 display display">Add Item</h2>
                </div>
                <?php
                if(isset($error)) {
                    foreach($error as $err)
                    {
                        ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-times-circle"></i> &nbsp; <?php echo $err; ?>
                        </div>
                        <?php
                    }
                }
                else if(isset($_GET['catadded'])) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check-circle"></i> Category successfully added.
                    </div>
                    <?php
                }
                ?>

                <div class="card-body">
                    <p>Add a new category for a group of items</p>
                    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" class="form-control" name="catname" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add" name="addcat" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- add shopping item form -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h2 class="h2 display">Add Shopping Item</h2>
                </div>
                <?php
                if(isset($error)) {
                    foreach($error as $err)
                    {
                        ?>
                        <div class="alert alert-danger">
                            <i class="fa fa-times-circle"></i> &nbsp; <?php echo $err; ?>
                        </div>
                        <?php
                    }
                }
                else if(isset($_GET['itemadded'])) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fa fa-check-circle"></i> Item successfully added.
                    </div>
                    <?php
                }
                ?>

                <div class="card-body">
                    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" class="form-control" name="name" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price GH¢</label>
                                    <input id="price" class="form-control" name="price" pattern="\d{0,10}\.?\d{0,2}" title="eg. 55.00" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" name="category" class="form-control">
                                        <option value="0">---</option>
                                        <?php
                                        $sql = "SELECT * FROM `category` ";
                                        $result = dbconnect()->query($sql);
                                        $i = 1;
                                        while ($row = $result->fetch_array()) {
                                        ?>
                                        <option value="<?php echo $row['catName'] ?>"><?php echo $row['catName'] ?></option>
                                        <?php  }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <label id="" class="file center-block">
                                        <input type="file" id="file" name="image" required/>
                                        <span class="file-custom"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Item" name="additem" class="mx-sm-3 btn btn-primary">
                            <input type="reset" value="Reset" class="mx-sm-3 btn btn-danger">

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>


<?php include "includes/footer.php" ?>
