<?php


function dbconnect()    {
    $connect_db = new Mysqli("localhost", "root", "", "online_retail_shop");

    if($connect_db->connect_error) {
        die("Connection Failed : " . $connect_db->error);
    }
    return $connect_db;

}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = dbconnect()->real_escape_string($data);
    return $data;
}


function redirect($url) {

    header("Location: $url");

}

// code
function code($length = 6) {
    $str = "";
    $characters  = array_merge(range("A", "Z"), range("0", "9"));
    $max = count($characters) - 1;

    for ($i = 0; $i < $length; $i++)  {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}




function addUser($uname, $email, $pwd, $tel) {

    $sql = "INSERT INTO `users` (`userID`, `username`, `email`, `password`, `tel_num`, `date_reg`) VALUES (NULL, '$uname', '$email', '$pwd', '$tel', CURRENT_TIMESTAMP)";
    $query = dbconnect()->query($sql);
    return $query;

}


// function for entering a new shopping item

function addItem($name, $price, $cat, $img)  {
    $sql = "INSERT INTO `items` (`itemID`, `itemName`, `itemPrice`, `itemCategory`, `itemImage`, `dateAdded`) VALUES (NULL, '$name', '$price', '$cat', '$img', CURRENT_TIMESTAMP)";
    $query = dbconnect()->query($sql);
    if ($query)   {
        return true;
    }   else    {
        return false;
    }

}


function addCategory($name) {
    $sql = "INSERT INTO `category` (`catID`, `catName`) VALUES (NULL, '$name')";
    $query = dbconnect()->query($sql);
    if ($query)   {
        return true;
    }   else    {
        return false;
    }

}

function updateItem($id, $name, $price) {
    $sql = "UPDATE `items` SET `itemName` = '$name', `itemPrice` = '$price' WHERE `items`.`itemID` = '$id'";
    $result = dbconnect()->query($sql);
    return $result;

}


function deleteItem($id, $name)   {
    $sql = "DELETE FROM `items` WHERE `itemID`='$id' AND `itemName`='$name'";
    $result = dbconnect()->query($sql);
    return $result;
}

function addCart ($code, $id, $qty, $total, $date) {
    $sql = "INSERT INTO `cart` (`code`, `itemid`,`qty`, `total`, `date`) VALUES ('$code', '$id', '$qty', '$total', '$date')";
    $result = dbconnect()->query($sql);
    return $result;
}

function deleteCart($code)    {
    $sql = "DELETE FROM `cart` WHERE code = '$code'";
    $result = dbconnect()->query($sql);
    return $result;
}


function addSales ($code, $uid, $fname, $email, $loc, $tel, $total, $notes)    {
    $sql = "INSERT INTO `sales` (`salesID`, `salesCode`, `user_id`, `full_name`, `email`, `address`, `tel_num`, `status`, `totalAmount`, `notes`, `sales_date`) 
            VALUES (NULL, '$code', '$uid', '$fname', '$email', '$loc', '$tel', 'not paid', '$total', '$notes', CURRENT_TIMESTAMP)";
    $result = dbconnect()->query($sql);
    return $result;
}



function deleteSale($id)  {
    $sql = "DELETE FROM `sales` WHERE salesID = '$id'";
    $result = dbconnect()->query($sql);
    return $result;
}
