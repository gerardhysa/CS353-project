<?php
/**
 * Created by PhpStorm.
 * User: Xhoana Aliu
 * Date: 5/11/2018
 * Time: 5:29 PM
 */
include "layout.php";
session_start();
$conference_name = "conf";
$date = 2017;
$location = "loc";

$sql ="SELECT title,name,conference_name, date, location, date_of_publication, institution_name 
FROM Paper NATURAL JOIN Write_paper NATURAL JOIN User NATURAL JOIN Has_author NATURAL JOIN 
  Submit_to_conference NATURAL JOIN Journal NATURAL JOIN User_role natural join Has_author
WHERE role = 1 and conference_name = '$conference_name' and date = $date and location = $location and author_email_address = email_address";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
    <script>
        .container{width:500px;}
        .item1, item2{width:200px;}
        .item1{float:left;}
        .item2{float:right;}
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

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
<div class="container" style="width:1200px;">

    <br /><br />

    <div class="row">

        <br class="col-md-12" style="margin-bottom: 50px"
        <br>
        <h5 style="float: left">Conference: </h5>
        <h5 style="float: right" >Date: </h5>
        </br><hr><br>
        <h5 style="float: left" >Location: </h5>
        <h5 align="right" style="float: right" >Publication Count: </h5>
        </br>
        <table id="example" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Paper</th>
                <th>Author</th>
                <th>Institution</th>
                <th>Date</th>
            </tr>
            </thead>
            <?php
            while($row = mysqli_fetch_array($result))
            {
                echo '  
                      <tr>  
                      <td><a href="">'.$row["title"].'</a></td>  
                      <td>'.$row["name"].'</td>  
                      <td>'.$row["institution_name"].'</td>  
                      <td>'.$row["date_of_publication"].'</td>  
                      </tr>  
                      ';
            }
            ?>
        </table>

    </div>

</div>
</div>

</body>
</html>