<?php
session_start();
require_once "../../dbfunctions/db.php";



if (isset($_POST['delsale'])) {

    $id = $_POST['id'];
    $code = $_POST['code'];


    if (deleteCart($code) == true) {
        if (deleteSale($id) == true) {
            redirect("../index.php?order+deleted");
        }

    } else {
        redirect("../index.php?error+occurred");
    }

}
