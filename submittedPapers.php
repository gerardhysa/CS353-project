<?php
include "layout.php";
session_start();

$email_address = $_SESSION['email_address'];

$sql ="SELECT * 
FROM Submitted_editor_j 
WHERE role = 1";

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

<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 50px">

            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Paper</th>
                    <th>Author</th>
                    <th>Institution</th>
                    <th>Submission Date</th>
                    <th>Claim</th>
                </tr>
                </thead>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo '  
                               <tr>  
                                    <td><a href="">'.$row["title"].'</a></td>  
                                    <td><a href="">'.$row["name"].'</a></td>  
                                    <td><a href="">'.$row["institution_name"].'</a></td>   
                                    <td>'.$row["submission_date_j"].'</td>  
                                    <td align="center"><form action="controller.php" method="post">
                                         <input type="hidden" value="'.$row['paper_id'].'" name="claim_button">
                                        <input type="submit" value="Claim" class="btn-success">
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
