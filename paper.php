<?php
/**
 * Created by PhpStorm.
 * User: Xhoana Aliu
 * Date: 5/3/2018
 * Time: 2:44 PM
 */
include "layout.php";
session_start();

$email_address = $_SESSION['email_address'];
//$paper_id = $_POST['write_review_button'];
$paper_id = $_GET['id'];

$sql = "SELECT paper_id,title,abstract,name,file, comment_content, rating_points 
    FROM Paper natural join User as u natural join User_role as ur natural join Write_paper as wp natural join Comment natural join Rate  
    WHERE role = 1 and paper_id = '$paper_id' and wp.author_email_address = ur.email_address and wp.author_email_address = u.email_address";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sql1 ="SELECT name
    FROM User  
    WHERE email_address = '$email_address'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);
$sql2 ="SELECT comment_content
    FROM Comment  
    WHERE paper_id = '$paper_id'";
$result2 = mysqli_query($conn, $sql2);
//$row2 = mysqli_fetch_array($result2);
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
        <textarea class="form-control" id="writeComment" rows="6" name="writeComment" readonly></textarea>
        <label>Author Name</label>
        <input class="form-control" type="text" placeholder="'.$row['name'].'" readonly>
        <label>Average Rating Points</label>
        <input class="form-control" type="text" placeholder="avg rate" readonly>
        <br /><br />
     
         <form action="controller.php" method="POST">
        <label>Rate Paper</label>
         <select class="form-control input-lg" name="rate">
                        <option selected>Choose...</option>
                        <option name="rate[]" id="rate1" value="1">1</option>
                        <option name="rate[]" id="rate2" value="2">2</option>
                        <option name="rate[]" id="rate3" value="3">3</option>
                        <option name="rate[]" id="rate4" value="4">4</option>
                        <option name="rate[]" id="rate5" value="5">5</option>
                    </select>
                    
                    <br />
                    
          <label>Write Comment</label>
         <textarea class="form-control" id="writeComment" rows="3" name="writeComment"></textarea>
         <br />
           <input  type="hidden" value="'.$row['paper_id'].'" name="submit_comment_button">
          
        <input style="float: right" type="submit" value="Submit Comment" class="btn-primary">
        <br />
         
    </form>
    ';
            while($row2 = mysqli_fetch_array($result2)){
                echo'
                    <textarea class="form-control" id="readComment" rows="3" name="readComment" placeholder="'.$row['comment_content'].'"readonly></textarea>
                    <br />';
            } ?>
</body>
</html>