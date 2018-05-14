<?php
include "layout.php";
session_start();

$email_address = $_SESSION['email_address'];
$password = $_SESSION['password'];


$sql = "SELECT * FROM User WHERE email_address = '$email_address' and password = '$password'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_array($result);

//to get the photo from the database

$sql1 = "SELECT photo FROM User WHERE email_address = '$email_address' and password = '$password'";
$result1 = mysqli_query($conn,$sql1);

$row1 = mysqli_fetch_array($result1);


?>
<!doctype html>
<html lang="en">
<head>
    <style>
        /* Stackoverflow preview fix, please ignore */
        .navbar-nav {
            flex-direction: row;
        }

        .nav-link {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
        }

        /* Fixes dropdown menus placed on the right side */
        .ml-auto .dropdown-menu {
            left: auto !important;
            right: 0px;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: left;
        }

    </style>


</head>

<body>


<nav class="navbar navbar-expand navbar-light bg-light"

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="userHomepage.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="subscriptions.php">My Subscriptions</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="journals.php">Journals</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown navbar-right active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="userProfile.php">My Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
</nav>

<?php
echo '
    <h2 align="center" style="margin-top: 50px">'.$row['name'].'\'s Profile</h2>';
?>

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
            <form action="controller.php" method="POST">

                <label>Name</label>
                <input type="text" name="name" class="form-control input-lg" value="'.$row['name'].'">


                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control input-lg" value="'.$row['lastname'].'">

                <label>Email Address</label>
                <input type="email" name="email_address" class="form-control input-lg" value="'.$row['email_address'].'" readonly>

                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control input-lg" value="'.$row['date_of_birth'].'">

                <hr>

                <div class="col-sm-6 col-md-offset-3" style="margin-bottom: 50px">
                    <input type="hidden" name="_token" value="">
                    <input type="submit" class="btn btn-success btn-block" name="update_profile">
                </div>


            </form> ';
            ?>
        </div>


    </div>
</div>
</div>
</body>
</html>