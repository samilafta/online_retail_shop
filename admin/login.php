<?php
session_start();
require_once "../dbfunctions/db.php";


if (isset($_SESSION['admin']))   {
    redirect("index.php");
    exit();
}

if (isset($_POST['login'])) {

    $uname = validate($_POST['uname']);
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM admin WHERE uname = '$uname' AND pwd = '$pwd'";
    $run = dbconnect()->query($sql);
    if ($run->num_rows == 1)   {
        $fetch = $run->fetch_array();
        $_SESSION['admin'] = $fetch['uname'];
        redirect("index.php");
    }   else    {
        $error = "Your username or password is incorrect!";
    }
}

?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jamin Shop | admin Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="col-md-8 form-outer text-center d-flex align-items-center">
          <div class="form-inner col-md-12">
            <div class="logo text-uppercase"><strong class="text-primary">Jamin Shop</strong></div>
            <p>Admin Login</p>

              <?php
              if(isset($error)) {
                  ?>
                  <div class="alert alert-danger">
                      <i class="fa fa-times-circle"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
              }
              ?>

            <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <div class="form-group">
                <label for="login-username" class="label-custom">User Name</label>
                <input id="login-username" type="text" name="uname" required>
              </div>
              <div class="form-group">
                <label for="login-password" class="label-custom">Password</label>
                <input id="login-password" type="password" name="pwd" required>
              </div>
                <button id="login" name="login" class="btn btn-primary">Login</button>
              <!-- This should be submit button but I replaced it with <a> for demo purposes-->
            </form>
          </div>
          <div class="copyrights text-center">
            <p>Designed by Jamin Shop</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>