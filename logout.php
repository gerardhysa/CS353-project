<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/8/2018
 * Time: 4:32 PM
 */
include 'layout.php';
include "session.php";
session_start();

$_SESSION['email_address'] = null;
unset($_SESSION['email_address']);
session_destroy();
header("Location: sign_in.php");


?>