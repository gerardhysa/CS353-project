<?php
include "layout.php";
session_start();


$email_address = $_SESSION['email_address'];

$sql ="select paper_id, title, email_address, role, name, submission_date_j, institution_name 
from Paper natural join Submit_to_journal natural join journal_has_reviewer natural join Write_paper natural join User natural join Has_author natural join User_role 
where author_email_address = email_address and role = 1 AND paper_id not in (SELECT paper_id FROM review WHERE review_grade is NOT null and review_content is NOT null) ";

$result = mysqli_query($conn, $sql);




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


<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 50px">

            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Paper</th>
                    <th>Author</th>
                    <th>Submission Date</th>
                    <th>Institution</th>
                    <th>Review / Grade</th>
                </tr>
                </thead>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo '  
                               <tr>  
                                    <td><a href="">'.$row["title"].'</a></td>  
                                    <td><a href="">'.$row["name"].'</a></td>  
                                    <td>'.$row["submission_date_j"].'</td>  
                                    <td><a href="">'.$row["institution_name"].'</a></td>   
                                   <td align="center"><form action="writeReview.php" method="POST">
                                         <input type="hidden" value="'.$row['paper_id'].'" name="write_review_button">
                                        <input type="submit" value="Write Review" class="btn-info">
                                    </form>
                                    </td>
                                    
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
