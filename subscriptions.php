<?php
include "layout.php";
session_start();


$email_address = $_SESSION['email_address'];


$sql ="SELECT ISSN,journal_name FROM Subscribe NATURAL JOIN Journal WHERE email_address = '$email_address'";
$result = mysqli_query($conn, $sql);

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

<div class="container">
    <div class="row" >
        <div class="col-8 mx-auto" style="margin-top: 50px" >

            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Journal</th>
                    <th>UnSubscribe</th>
                </tr>
                </thead>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo '  
                               <tr>  
                                    <td align="center"><a href="journalPage.php?id="'.$row['ISSN'].'>'.$row["journal_name"].'</a></td> 
                                    
                                                                                                         
                                    <td align="center"><form action="controller.php" method="post">
                                         <input type="hidden" value="'.$row['ISSN'].'" name="unsub-button">
                                        <input type="submit" value="UnSubscribe" class="btn-danger">
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

