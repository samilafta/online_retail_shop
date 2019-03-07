<?php
session_start();
include "../dbfunctions/db.php";

if (isset($_POST['confirm'])) {

    $fname = validate($_POST['fname']);
    $address = validate($_POST['location']);
    $notes = validate($_POST['notes']);
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    $code = $_POST['code'];
    $amount = $_POST['total'];
    $tel = $_POST['tel'];

    if (addSales($code, $userid, $fname, $email, $address, $tel, $amount, $notes) == true)   {
        unset($_SESSION['code']);
        $code = code(6);
        $_SESSION['code'] = $code;
        redirect("../orders.php");
    }


}