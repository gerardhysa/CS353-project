<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/13/2018
 * Time: 8:34 PM
 */
include "layout.php";
session_start();


$ISSN = $_GET['id'];

$email_address = $_SESSION['email_address'];

$sql = "SELECT paper_id,status,title,journal_name,year_of_publication,date_of_publication,institution_name,name 
FROM Journal natural join Submit_to_journal natural join Paper natural join Write_paper natural join User natural join User_role natural join Has_author
WHERE ISSN = '$ISSN' and status = 'Published' and role = 1 and author_email_address = email_address";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql);
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
                <a class="dropdown-item" href="userProfile.php">My Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
</nav>

<div class="container" style="width:800px;">

    <br /><br />

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 50px">

            <?php
            echo '
            
            <h5>Journal: '.$row['journal_name'].'</h5>
            
            
            <h5>Year of Publication: '.$row['year_of_publication'].'</h5>
            
            <br></<br>
            ';
            ?>

             <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Paper</th>
                    <th>Author</th>
                    <th>Institution</th>
                    <th>Publication Date</th>

                </tr>
                </thead>
                <?php

                while($row2 = mysqli_fetch_array($result2))
                {



                    echo '  
                               <tr>  
                                    <td><a href="paper.php?id='.$row2['paper_id'].'">'.$row2["title"].'</a></td>   
                                    <td><a href="author.php?id='.$row2['email_address'].'">'.$row2["name"].'</a></td>  
                                    <td><a href="institution.php?id='.$row2['institution_name'].'">'.$row2["institution_name"].'</a></td>
                                    <td>'.$row2['date_of_publication'].'</td>  
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

