<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/13/2018
 * Time: 4:02 PM
 */
include "layout.php";
session_start();

    $email_address = $_SESSION['email_address'];

    $paper_id = $_POST['write_review_button'];


$sql = "SELECT paper_id,title,abstract,name,submission_date_j,file, reviewer_email_address 
FROM Paper natural join User as u natural join User_role as ur natural join Write_paper as wp natural join Submit_to_journal natural join Review as r 
WHERE role = 1 and paper_id = '$paper_id' and r.reviewer_email_address = '$email_address' and wp.author_email_address = ur.email_address and wp.author_email_address = u.email_address";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);



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
            <a class="nav-link" href="assignedPapers.php">Assigned Papers</a>
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
                echo '

        <label>'.$row['title'].'</label>
        
        <form action="controller.php" method="POST" style="float: right">
        <input type="hidden" value="'.$row['paper_id'].'" name="download_button">
        <input type="submit" value="Download" class="btn-success">
        </form>
       
        <br /><br />
       
        <label>Abstract</label>
        <input class="form-control" type="text" placeholder="'.$row['abstract'].'" readonly>

        <label>Author Name</label>
        <input class="form-control" type="text" placeholder="'.$row['name'].'" readonly>
    <br /><br />
        
         <form action="controller.php" method="POST">
        <label>Select Grade</label>
         <select class="form-control input-lg" name="grade">
                        <option selected>Choose...</option>
                        <option name="grade[]" id="grade1" value="1">1</option>
                        <option name="grade[]" id="grade2" value="2">2</option>
                        <option name="grade[]" id="grade3" value="3">3</option>
                        <option name="grade[]" id="grade4" value="4">4</option>
                        <option name="grade[]" id="grade5" value="5">5</option>
                    </select>
                    
                    <br /><br />
                    
          <label>Write Review</label>
         <textarea class="form-control" id="writeReview" rows="6" name="writeReview"></textarea>
         <br /><br />
           <input  type="hidden" value="'.$row['paper_id'].'" name="submit_review_button">
        <input style="float: right" type="submit" value="Submit" class="btn-primary">
         
    </form>
    ';
  ?>
</body>
</html>

<?php


