<?php
include "layout.php";
session_start();


$email_address = $_SESSION['email_address'];

$sql ="SELECT title,name,institution_name,journal_name,date_of_publication,ISSN,paper_id,status
FROM Paper NATURAL JOIN Write_paper NATURAL JOIN User NATURAL JOIN Has_author NATURAL JOIN Submit_to_journal NATURAL JOIN Journal NATURAL JOIN User_role 
WHERE role = 1 and author_email_address = email_address and status = 'Published' ";
$result = mysqli_query($conn, $sql);



$sql1 ="SELECT name
FROM User  
WHERE email_address = '$email_address'";

$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_array($result1);

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
            <a class="nav-link" href="reviewerHomepage.php">Home</a>
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
                echo $row['name'];
                ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="reviewerProfile.php">My Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 50px">

            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Paper</th>
                    <th>Author</th>
                    <th>Institution</th>
                    <th>Journal</th>
                    <th>Date</th>
                </tr>
                </thead>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo '  
                               <tr>  
                                   <td><a href="paper.php?id='.$row['paper_id'].'">'.$row["title"].'</a></td>   
                                    <td><a href="author.php?id='.$row['email_address'].'">'.$row["name"].'</a></td>  
                                    <td><a href="institution.php?id='.$row['institution_name'].'">'.$row["institution_name"].'</a></td>
                                     <td><a href="journalPage.php?id='.$row['ISSN'].'">'.$row["journal_name"].'</a></td>
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
