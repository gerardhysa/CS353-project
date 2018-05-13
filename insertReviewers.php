<?php
/**
 * Created by PhpStorm.
 * User: Gerard
 * Date: 5/12/2018
 * Time: 2:32 PM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if(isset($_POST["submit_reviewer"])) {

    $paper_id = intval($_POST['submit_reviewer']);

}




if(isset($_POST["framework"]))
{

    $email_address = $_SESSION['email_address'];

    $count = 0;

    foreach($_POST["framework"] as $row) {
        ++$count;
    }
    if($count <= 3) {

        foreach ($_POST["framework"] as $row) {
            $framework = $row;
            $query = "INSERT INTO Assign(reviewer_email_address,paper_id,editor_email_address)
              VALUES('$framework','$paper_id','$email_address')";

            $query1 = "INSERT INTO Review(reviewer_email_address,paper_id,review_content,review_grade)
              VALUES('$framework','$paper_id',NULL, NULL )";

            $res = mysqli_query($conn, $query);
            $res1 = mysqli_query($conn, $query1);

        }
        echo 'Data Inserted';
    }else{
        echo 'You cannot assign more than 3 reviewers to a paper';
    }
}

?>