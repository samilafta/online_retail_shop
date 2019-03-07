<?php
session_start();
require_once "../../dbfunctions/db.php";


if (isset($_POST['confirm'])) {

    $id = $_POST['id'];

    $sql = "UPDATE `sales` SET `status` = 'paid' WHERE `sales`.`salesID` = '$id'";
    $result = dbconnect()->query($sql);

    if ($result)   {
        redirect("../index.php?payment+confirmed");
    }   else    {
        redirect("../index.php?error+occurred");
    }

}
