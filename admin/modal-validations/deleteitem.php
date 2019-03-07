<?php
require_once "../../dbfunctions/db.php";


if (isset($_POST['itemdelete']))    {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $run = deleteItem($id, $name);
    if ($run)   {
        redirect("../itemlist.php?item+deleted");
    }   else    {
        redirect("../itemlist.php?error+occurred");
    }
}
