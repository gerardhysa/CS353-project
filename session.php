<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/8/2018
 * Time: 3:12 PM
 */
include('layout.php');
session_start();

$email_address = $_SESSION['email_address'];
$password = $_SESSION['password'];

$ses_sql = mysqli_query($conn,"select email_address from User where email_address = '$email_address' ");

$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session = $row['email_address'];

if(!isset($_SESSION['email_address'])){
    header("location:sign_in.php");
}

?>