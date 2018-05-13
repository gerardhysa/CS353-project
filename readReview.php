<?php
include "layout.php";
session_start();

$email_address = $_SESSION['email_address'];



$paper_id = $_POST['read_review_button'];

$sql ="SELECT name,reviewer_email_address,paper_id,review_content,review_grade 
FROM user_role NATURAL JOIN user, Review natural join assign 
WHERE reviewer_email_address = email_address and review_content is not null and review_grade is not null 
AND editor_email_address = '$email_address' AND paper_id = '$paper_id' and role = 3 ";

$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);



$sql1 ="SELECT name
FROM User  
WHERE email_address = '$email_address'";

$result1 = mysqli_query($conn, $sql1);
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
            <a class="nav-link" href="editorHomepage.php">Home</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="subscriptions.php">My Subscriptions</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="journals.php">Journals</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="submittedPapers.php">Submitted Papers</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="claimedPapers.php">Claimed Papers</a>
        </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown navbar-right active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                echo $row1['name'];
                ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="editorProfile.php">My Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
</nav>


<div class="container" style="width:600px;">

    <br /><br />



<div class="row">

    <div class="col-md-12" style="margin-bottom: 50px">

        <?php

if($count === 0){
    echo'
    
    <label>No Reviews Available</label>';

}else{
 while($row = mysqli_fetch_array($result))
                {
                    echo '

     <label>Reviewer</label>
        <input class="form-control" type="text" placeholder="'.$row['name'].'" readonly>

    <label>Grade</label>
        <input class="form-control" type="text" placeholder="'.$row['review_grade'].'" readonly>

    <label>Review</label>
        <input class="form-control" type="text" placeholder="'.$row['review_content'].'" readonly>


    <br /><br />
    <hr>
                                           ';
                } }
        ?>


    </div>

</div>
</div>

</body>
</html>
