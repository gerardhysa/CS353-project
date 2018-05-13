<?php

include "layout.php";
session_start();



if(isset($_POST['accept_button'])){

    $rowToAccept = $_POST['accept_button'];
    $email_address = $_SESSION['email_address'];
    acceptPaper($conn,$email_address,$rowToAccept);
}


function acceptPaper($conn, $email_address, $rowToAccept){

    $start_date = date("Y/m/d");

    $sql = "UPDATE Decide SET decision = 'Accepted' 
WHERE editor_email_address = '$email_address' and paper_id = '$rowToAccept'";

    $res = mysqli_query($conn, $sql);

    $sql1 = "UPDATE Paper SET status = 'Published', date_of_publication = '$start_date'
WHERE paper_id = '$rowToAccept'";

    $res1 = mysqli_query($conn, $sql1);

    header("location:claimedPapers.php");


}

if(isset($_POST['reject_button'])){

    $rowToReject = $_POST['reject_button'];
    $email_address = $_SESSION['email_address'];
    rejectPaper($conn,$email_address,$rowToReject);
}


function rejectPaper($conn, $email_address, $rowToReject){

    $sql = "UPDATE Decide SET decision = 'Rejected' 
WHERE editor_email_address = '$email_address' and paper_id = '$rowToReject'";

    $res = mysqli_query($conn, $sql);

    $sql1 = "UPDATE Paper SET status = 'Uploaded'
WHERE paper_id = '$rowToReject'";

    $res1 = mysqli_query($conn, $sql1);

    header("location:claimedPapers.php");

}


if(isset($_POST['register-button'])){
    addUser($conn);
}

if(isset($_POST['claim_button'])){

    $rowToClaim = intval($_POST['claim_button']);
    $email_address = $_SESSION['email_address'];
    claimPaper($conn, $email_address,$rowToClaim);
}


function claimPaper($conn,$email_address,$rowToClaim){

    $paper_id = mysqli_real_escape_string($conn, $_POST['paper_id']);


    $sql = "INSERT INTO Decide(editor_email_address,paper_id,decision)
VALUES('$email_address','$rowToClaim',NULL )";

    $res = mysqli_query($conn, $sql);

    header("location:submittedPapers.php");


}

if(isset($_POST['update_profile'])){

    updateProfile($conn);
}



function updateProfile($conn){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);


    $sql = "UPDATE User SET name = '$name', lastname = '$lastname',  date_of_birth = '$date_of_birth' WHERE email_address = '$email_address'";

    $res = mysqli_query($conn, $sql);

    header("location:userProfile.php");

}




if(isset($_POST['unsub-button'])){


    $rowToUnSubscribe = $_POST['unsub-button'];
    $email_address = $_SESSION['email_address'];
    unSubscribe($conn,$email_address,$rowToUnSubscribe);
}

function unSubscribe($conn, $email_address,$rowToUnSubscribe){


$sql = "DELETE FROM Subscribe WHERE email_address = '$email_address' AND ISSN ='$rowToUnSubscribe'";

    $res = mysqli_query($conn, $sql);

    header("location:subscriptions.php");
}

if(isset($_POST['sub-button'])){

    $rowToSubscribe = $_POST['sub-button'];
    $email_address = $_SESSION['email_address'];
    subscribe($conn,$email_address,$rowToSubscribe);
}


function subscribe($conn,$email_address,$rowToSubscribe){

    $start_date = date("Y/m/d");
    $end_date = date("Y/m/d",strtotime("+1 week"));


    $sql = "INSERT INTO Subscribe(email_address,ISSN,start_date,end_date)
VALUES('$email_address','$rowToSubscribe','$start_date','$end_date')";

    $res = mysqli_query($conn, $sql);

    header("location:journals.php");

}



function addUser($conn)
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if ($_POST["password"] === $_POST["password_confirmation"]) {
        $sql = "INSERT INTO User(email_address,name,lastname,password,date_of_birth,age,photo)
            VALUES('$email_address','$name','$lastname','$password',NULL ,NULL,NULL)";

        if (!mysqli_query($conn, $sql)) {
            die('<script>
       
                alert("This email address is already in our system!");
                window.location.href="register.php";
        
                </script>\';');
        }

        if (!empty($_POST['role'])) {
            // Loop to store and display values of individual checked checkbox.
            foreach ($_POST['role'] as $selected) {
                echo "<p>" . $selected . "</p>";

                if ($selected == 0) {
                    $sql = "INSERT INTO User_role(email_address,role)
                    VALUES('$email_address',0)";

                    $res = mysqli_query($conn, $sql);
                } elseif ($selected == 1) {
                    $sql = "INSERT INTO User_role(email_address,role)
                    VALUES('$email_address',1)";

                    $sql1 = "INSERT INTO Author(author_email_address,avg_citations_per_paper,webpage)
                    VALUES('$email_address',NULL ,NULL )";

                    $res = mysqli_query($conn, $sql);
                    $res1 = mysqli_query($conn, $sql1);
                } elseif ($selected == 2) {
                    $sql = "INSERT INTO User_role(email_address,role)
                    VALUES('$email_address',2)";

                    $sql1 = "INSERT INTO Editor(editor_email_address,webpage)
                    VALUES('$email_address',NULL)";

                    $res = mysqli_query($conn, $sql);
                    $res1 = mysqli_query($conn, $sql1);
                } else {
                    $sql = "INSERT INTO User_role(email_address,role)
                VALUES('$email_address',3)";

                    $sql1 = "INSERT INTO Reviewer(reviewer_email_address,webpage)
                VALUES('$email_address',NULL)";

                    $res = mysqli_query($conn, $sql);
                    $res1 = mysqli_query($conn, $sql1);
                }
            }
        }
        header("location:sign_in.php");
    } else {
        die('<script>
       
                alert("The password is not the same!");
                window.location.href="register.php";
        
                </script>\';');
    }
}

if(isset($_POST['loginButton'])){
    $selected = $_POST['admin'];
    signInAs($conn,$selected);
}

if(isset($_POST["avatar"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    $email_address = $_SESSION['email_address'];
    if ($check !== false) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));


        //Insert image content into database
        $sql = "UPDATE User SET photo = '$imgContent' WHERE email_address = '$email_address'";
        $res = mysqli_query($conn, $sql);
    }

    header("Location:userProfile.php");
}
function signInAs($conn, $selected)
{
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT email_address FROM User WHERE email_address = '$email_address' and password = '$password'";

    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {

        //session_register("myusername");
        $_SESSION['email_address'] = $email_address;
        $_SESSION['password'] = $password;




        // Loop to store and display values of individual checked checkbox.

        if ($selected == 0) {
            $sql1 = "SELECT email_address FROM User_role WHERE email_address = '$email_address' and role = '$selected'";

            $result1 = mysqli_query($conn,$sql1);

            $count1 = mysqli_num_rows($result1);

            if($count1 == 1) {
                header("location:userHomepage.php");
            }else{

                echo ' <script>
       
            alert("Your Selected Role is invalid");
            window.location.href="sign_in.php";
        
    </script>';


            }
        } elseif ($selected == 1) {
            $sql2 = "SELECT email_address FROM User_role WHERE email_address = '$email_address' and role = '$selected'";

            $result2 = mysqli_query($conn,$sql2);

            $count2 = mysqli_num_rows($result2);

            if($count2 == 1) {
                header("location:authorHomepage.php");
            }else{
                echo ' <script>
       
            alert("Your Selected Role is invalid");
            window.location.href="sign_in.php";
        
    </script>';

            }
        } elseif ($selected == 2) {
            $sql3 = "SELECT email_address FROM User_role WHERE email_address = '$email_address' and role = '$selected'";

            $result3 = mysqli_query($conn,$sql3);

            $count3 = mysqli_num_rows($result3);

            if($count3 == 1) {
                header("location:editorHomepage.php");
            }else{
                echo ' <script>
       
            alert("Your Selected Role is invalid");
            window.location.href="sign_in.php";
        
    </script>';

            }
        } elseif ($selected == 3) {

            $sql4 = "SELECT email_address FROM User_role WHERE email_address = '$email_address' and role = '$selected'";

            $result4 = mysqli_query($conn,$sql4);

            $count4 = mysqli_num_rows($result4);

            if($count4 == 1) {
                header("location:reviewerHomepage.php");
            }else {

                echo ' <script language="JavaScript">
       
            alert("Your Selected Role is invalid");
            window.location.href="sign_in.php";
        
    </script>';

            }
            }
    }else {

        echo ' <script language="JavaScript">
       
            alert("Your Login Name or Password is invalid");
            window.location.href="sign_in.php";
        
    </script>';


    }
}

?>