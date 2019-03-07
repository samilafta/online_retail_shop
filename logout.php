<?php
session_start();
require_once "dbfunctions/db.php";

unset($_SESSION['username']);
session_destroy();

redirect("index.php");
exit;
