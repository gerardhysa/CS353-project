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


    $paper_id = $_POST['submit_coauthor'];

if(isset($_POST["framework"]))
{
        foreach ($_POST["framework"] as $row) {

            $framework = $row;

            $query = "INSERT INTO Write_paper(author_email_address,paper_id)
              VALUES('$framework','$paper_id')";

            $res = mysqli_query($conn, $query);

        }

}



?>