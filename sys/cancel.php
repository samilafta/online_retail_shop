<?php
session_start();

require_once "../dbfunctions/db.php";

$code = $_SESSION['code'];

if (deleteCart($code) == true) {

    redirect("../checkout.php");

} else {
    redirect("../checkout.php?error+occurred");
}