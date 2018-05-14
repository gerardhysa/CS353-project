<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/13/2018
 * Time: 11:00 PM
 */
include "layout.php";
session_start();


$new_paper_id = "SELECT MAX(paper_id) AS max_id FROM Paper";
$result_paper_id = mysqli_query($conn,$new_paper_id);
$row_paper_id = mysqli_fetch_array($result_paper_id);
$paper_id = intval($row_paper_id['max_id']) + 1;



$email_address = $_SESSION['email_address'];


$journal_list = "SELECT journal_name,ISSN
FROM Journal ";

$result_journal = mysqli_query($conn, $journal_list);


$sql1 ="SELECT name
FROM User  
WHERE email_address = '$email_address'";

$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_array($result1);

?>
<!doctype html>
<html lang="en">
<head>

    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js.map"></script>



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
            <a class="nav-link" href="uploadPaper.php">Upload Paper</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="myPapers.php">My Papers</a>
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
                <a class="dropdown-item" href="editorProfile.php">My Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</div>
</nav>

<div class="container" style="width: 800px">
    <div class="row">
        <div class="col-md-12" style="margin-top: 50px">

            <form action="controller.php" method="POST">

                <label>Paper Title: </label>
                <input id="paper_title" type="text" class="form-control" name="paper_title" placeholder="Enter paper title" required="required" autofocus >
                <br/><br/>
                <label>Paper Abstract: </label>
                <textarea class="form-control" id="paper_abstract" rows="6" name="paper_abstract"></textarea>

                            <br/><br/><br/>
                                <label>Select Journals</label>

                            <select name="select_journal">
                                <option selected>Choose...</option>
                        <?php

                            while($row3 = mysqli_fetch_array($result_journal)){
                        echo '
                        
                         <option value="'.$row3['ISSN'].'">'.$row3['journal_name'].'</option>
                    
                         ';}
                            ?></select>

                            <br/><br/><br/>

                               <label>Select paper to upload:</label>

                                <input type="file" name="file_upload"/>

                            <br/><br/><br/>
                            <div class="container" style="width: 800px" align="center">
                                <div class="row">
                                    <div class="col-md-12" style="margin-bottom: 100px">
                                        <?php

                                        echo '
                                        
                                         <input type="hidden" name="paper_id"  value="'.$paper_id.'">   
                                <input class="btn-success" type="submit" name="upload_paper" />
                               '; ?>
                                    </div>
                                </div>
                            </div>
            </form>

</body>
</html>
