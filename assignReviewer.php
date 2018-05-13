<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/11/2018
 * Time: 10:46 PM
 */
include "layout.php";
session_start();

$email_address = $_SESSION['email_address'];

$sql ="SELECT name, email_address 
from User NATURAL JOIN User_role 
where role = 3 and email_address not in ( SELECT assigned_reviewed from assigned_and_reviewed where  no > 5)";

$result = mysqli_query($conn, $sql);


$sql1 ="SELECT name
FROM User  
WHERE email_address = '$email_address'";

$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

if(isset($_POST['assign_button'])) {

    $paper_id = intval($_POST['assign_button']);

}

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

    <script>
        $(document).ready(function(){
            $('#framework').multiselect({
                nonSelectedText: 'Select Reviewer',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'400px'
            });

            $('#framework_form').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url:"insertReviewers.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        $('#framework option:selected').each(function(){
                            $(this).prop('selected', false);
                        });
                        $('#framework').multiselect('refresh');
                        alert(data);
                    }
                });
            });


        });
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

<div class="container" style="width:600px;">

    <br /><br />

    <form method="post" id="framework_form">
        <div class="form-group">
            <label>Select Reviewers</label>
            <select id="framework" name="framework[]" multiple class="form-control" >
                <?php
                while($row = mysqli_fetch_array($result)){
                    echo '
                        <option value="'.$row['email_address'].'">'.$row['name'].'</option>
                    
                ';}
                echo '
                
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" value="'.$paper_id.'" name="submit_reviewer">
            <input type="submit" class="btn btn-info" name="submit_reviewer" value="Submit"/>
        </div>
        ';?>
    </form>

    <br />
</div>



</body>
</html>


