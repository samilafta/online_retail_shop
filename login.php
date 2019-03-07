<?php
session_start();
include "dbfunctions/db.php";

if (isset($_POST['login'])) {
    $uname = validate($_POST['username']);
    $pwd = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pwd'";
    $result = dbconnect()->query($sql);
    $fetch = $result->fetch_assoc();

    if ($result->num_rows == 1)   {
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['user_id'] = $fetch['userID'];
        $_SESSION['tel'] = $fetch['tel_num'];

        redirect("index.php");
    } else {
        $error[] = "Your username and password is incorrect.";
    }

}

?>

<?php include "includes/header.php"; ?>

<!--banner-->
<div class="banner1">
    <div class="container">
        <h3><a href="index.php">Home</a> / <span>Login</span></h3>
    </div>
</div>
<!--banner-->

<!--content-->
<div class="content">
    <!--login-->
    <div class="login">
        <div class="main-agileits">
            <div class="form-w3agile">
                <h3>Login To Jamin Shop</h3>
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
                ?>


                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="key">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input  type="text" placeholder="Username" name="username" required="">
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input  type="password" placeholder="Password" name="password" required="">
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
            <div class="forg">
                <a href="register.php" class="forg-right">Register</a>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--login-->
</div>
<!--content-->

<?php include "includes/footer.php"; ?>
