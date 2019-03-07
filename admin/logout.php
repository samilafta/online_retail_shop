<?php
session_start();
require_once "../dbfunctions/db.php";

unset($_SESSION['admin_uname']);
session_destroy();

redirect("login.php");
exit;
