<?php
include "layout.php";
session_start();

$email_address = $_SESSION['email_address'];
$password = $_SESSION['password'];


$sql = "SELECT * FROM User WHERE email_address = '$email_address' and password = '$password'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($result);


$sql1 = "SELECT photo FROM User WHERE email_address = '$email_address' and password = '$password'";
$result1 = mysqli_query($conn,$sql1);

$row1 = mysqli_fetch_array($result1);


?>
<!doctype html>
<html lang="en">
<head>
    <h2 align="center" style="margin-top: 50px">User's Profile</h2>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2" align="center">

            <?php
            echo '
        <div class="col-md-12" style="margin-top: 50px">
            <img src="data:image/jpeg;base64,<?php echo base64_encode( $row1 ); ?>" style="width:150px;
                height:150px; float:left; border-radius:50%; margin-right:25px;">

           
           
           <form action="controller.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="image"/>
        <input class="btn-primary" type="submit" name="avatar" value="UPLOAD"/>
    </form>';
?>
        </div>

        <div class="col-md-12" style="margin-top: 120px">

            <?php

            echo '
            <form action="/profileupdate" method="POST">

                <label>Name</label>
                <input type="text" name="name" class="form-control input-lg" value="'.$row['name'].'">


                <label>Lastname</label>
                <input type="text" name="surname" class="form-control input-lg" value="'.$row['lastname'].'">

                <label>Email Address</label>
                <input type="email" name="address" class="form-control input-lg" value="'.$row['email_address'].'" readonly>

                <label>Date of Birth</label>
                <input type="date" name="address" class="form-control input-lg" value="'.$row['date_of_birth'].'">

                <hr>

                <div class="col-sm-6 col-md-offset-3" style="margin-bottom: 50px">
                    <input type="hidden" name="_token" value="">
                    <input type="submit" class="btn btn-success btn-block">
                </div>


            </form> ';
            ?>
        </div>


    </div>
    </div>
</div>
</body>
</html>