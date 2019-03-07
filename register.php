<?php
session_start();
include "dbfunctions/db.php";

if (isset($_POST['register'])) {
    $uname = validate($_POST['username']);
    $email = validate($_POST['email']);
    $pwd = $_POST['pwd'];
    $pwd2 = $_POST['pwd2'];
    $tel = $_POST['tel'];

    if($pwd === $pwd2) {
        $sql = "SELECT * FROM users WHERE username = '$uname'";

        $query = dbconnect()->query($sql);
        if($query->num_rows > 0) {
            $error[] = "Username already exists!.";
        } else {

            if(addUser($uname, $email, $pwd, $tel) === true) {

                redirect("register.php?joined");

            } else {

                $error[] = "An error occurred. Please try again.";

            }
        }

    } else {
        $error = "Passwords do not match";
    }


}


?>
<?php include "includes/header.php"; ?>

    <!--banner-->
    <div class="banner1">
        <div class="container">
            <h3><a href="index.php">Home</a> / <span>Register</span></h3>
        </div>
    </div>
    <!--banner-->

    <!--content-->
    <div class="content">
        <!--login-->
        <div class="login">
            <div class="main-agileits">
                <div class="form-w3agile form1">
                    <h3>Register</h3>

                    <!-- success and error alert -->
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
                    else if(isset($_GET['joined'])) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="fa fa-check-circle"></i> Successfully registered. <a href="login.php">login</a> here
                        </div>
                        <?php
                    }
                    ?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="key">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <input  type="text" placeholder="Username" name="username" required="">
                            <div class="clearfix"></div>
                        </div>
                        <div class="key">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input  type="text" placeholder="Email" name="email" required="">
                            <div class="clearfix"></div>
                        </div>
                        <div class="key">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input  type="password" placeholder="Password" name="pwd" required="">
                            <div class="clearfix"></div>
                        </div>
                        <div class="key">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input  type="password" placeholder="Confirm Password" name="pwd2" required="">
                            <div class="clearfix"></div>
                        </div>
                        <div class="key">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <input type="text" placeholder="Telephone" name="tel" pattern="[0-9]{10}" required="">
                            <div class="clearfix"></div>
                        </div>

                        <input type="submit" name="register" value="Submit" />
                    </form>
                </div>

            </div>
        </div>
        <!--login-->
    </div>
    <!--content-->


<?php include "includes/footer.php"; ?>
