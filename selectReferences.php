<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/13/2018
 * Time: 11:00 PM
 */
include "layout.php";
session_start();

$paper_id = $_POST['pass_references'];

$email_address =$_SESSION['email_address'];

$paper_list = "SELECT title,status,paper_id
FROM Paper
WHERE status = 'Published'";
$result_papers = mysqli_query($conn, $paper_list);


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
    <script>
        $(document).ready(function(){
            $('#framework').multiselect({
                nonSelectedText: 'Select References',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'400px'
            });

            $('#framework_form').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url:"insertReferences.php",
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

            <div class="ml-auto">
                <label>Select References</label>

                <form method="post" id="framework_form">
                    <select id="framework" name="framework[]" multiple class="form-control" >
                        <?php
                        while($row1 = mysqli_fetch_array($result_papers)){
                            echo '
                        <option value="'.$row1['paper_id'].'">'.$row1['title'].'</option>
                    
                ';}
                        echo '
                
                </select>
                </div>
                
        <div class="form-group">
            <input type="hidden" value="'.$paper_id.'" name="submit_to_references">
            <input type="submit" class="btn btn-info" name="submit_references" value="Submit"/>
        </div>
                ';?>
                </form>

                <?php
                echo '
                
<form action="myPapers.php" method="post">
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="finish" value="Finish"/>
    </div>
    
    
</form> ';
                ?>

            </div>
        </div>
    </div>
</div>


</body>
</html>


</body>
</html>
