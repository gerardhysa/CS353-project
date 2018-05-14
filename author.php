<?php
/**
 * Created by PhpStorm.
 * User: Xhoana Aliu
 * Date: 5/11/2018
 * Time: 5:29 PM
 */
include "layout.php";
session_start();
$email_address = $_GET['id'];
$sql ="SELECT paper_id,title,name,journal_name,date_of_publication,status,institution_webpage,ISSN, institution_name, webpage
FROM Paper NATURAL JOIN Write_paper NATURAL JOIN User NATURAL JOIN Has_author NATURAL JOIN Submit_to_journal NATURAL JOIN Journal NATURAL JOIN User_role NATURAL JOIN institution natural join  Author
WHERE role = 1 and author_email_address = email_address and status = 'Published' and author_email_address = '$email_address'";

$sql_publication_count ="SELECT author_email_address ,COUNT(paper_id) AS no_publications 
FROM paper NATURAL JOIN write_paper 
WHERE status = 'Published' and author_email_address = '$email_address'";

$result_publication_count = mysqli_query($conn, $sql_publication_count);
$row_publication_count = mysqli_fetch_array($result_publication_count);




$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

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

        <div class="col-md-12" style="margin-bottom: 50px">

            <?php
            echo '<h5 style="float: left">Author: '.$row['name'].'</h5>
            <h5 style="float: right" >Author\'s Webpage: '.$row['webpage'].'</h5>
            <br /><br />
            <h5 style="float: left" >Publication Count: '.$row_publication_count['no_publications'].'</h5>
            <h5 style="float: right" >Institution: '.$row['institution_name'].'</h5>
            ';
            ?>
            <br /><br />
            <br /><br />

            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Paper</th>
                    <th>Journal</th>
                    <th>Date</th>
                </tr>
                </thead>
                <?php
                while($row2 = mysqli_fetch_array($result2))
                {
                    echo '  
                               <tr>  
                                    <td><a href="paper.php?id='.$row2['paper_id'].'">'.$row2["title"].'</a></td>   
                                    <td><a href="journalPage.php?id='.$row2['ISSN'].'">'.$row2["journal_name"].'</a></td>
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