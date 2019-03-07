<?php
session_start();
 include "../dbfunctions/db.php";

 if (isset($_POST['addtocart'])) {

     $id = $_POST['id'];
     $price = $_POST['price'];
     $qty = $_POST['qty'];
     $date = $_POST['date'];

     $total = number_format($price * $qty, 2);

     $code = $_SESSION['code'];

     if (addCart($code, $id, $qty, $total, $date) == true)   {

         redirect("../products.php?added+to+cart");

     }  else {
         redirect("../products.php?error+occurred");
     }


 }