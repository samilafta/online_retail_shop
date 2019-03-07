<?php
session_start();

require_once "../dbfunctions/db.php";

if(isset($_POST['deleteitem'])) {
    $id = $_POST['id'];
    $sql = "DELETE from cart WHERE cartID='$id'";
    $result = dbconnect()->query($sql);

    if ($result)   {
        redirect("../checkout.php");
    }


}
