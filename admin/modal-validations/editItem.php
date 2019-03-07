<?php
require_once "../../dbfunctions/db.php";

if (isset($_POST['itemedit']))    {
    $id = $_POST['id'];
    $name = validate($_POST['name']);
    $price = $_POST['price'];

    $run = updateItem($id, $name, $price);

    if ($run)   {
        redirect("../itemlist.php?item+updated");
    }   else    {
        redirect("../itemlist.php?error+occured");
    }
}
