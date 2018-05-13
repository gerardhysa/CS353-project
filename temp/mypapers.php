<?php

/////////////Change this part/////////////
  session_start();

   $servername = "dijkstra.ug.bcc.bilkent.edu.tr";
   $my_username = "busra.arabaci";
   $my_password = "n3j8zl6";
   $dbname = "busra_arabaci";

   $conn = new mysqli($servername, $my_username, $my_password, $dbname);
   if ($conn->connect_error) {
       die("Connection failed: " . $con->connect_error);
   }
///////////////////////////////////////////
   $email_address = $_SESSION['email_address'];

   //Read papers
   $paper_sql = "SELECT * FROM Write_paper NATURAL JOIN Paper WHERE author_email_address='$email_address'";
   $paper_result = mysqli_query($conn,$paper_sql);
?>

<html>
<head>
	<title>Scientific Paper Management System</title>
	<meta charset="UTF-8">
</head>

<body>


	<table>
	  <tr>
	    <th>PAPERS</th>
	  </tr>

	  <!--Uplod paper part is in first row-->
	  <tr>
	  	<td><a href='uploadpaper.php'">UPLOAD A NEW PAPER</a></td>
	  </tr>
	<?php
	    if ($paper_result->num_rows > 0) {
	        // output data of each row
	        while($row = mysqli_fetch_array($paper_result)) {
	        	echo "<tr>";
	        	//Goes to editable page
	        	if($row['status'] == 'uploaded')
	        		$temp = "<a href='uploadpaper.php?paper_id=".$row["paper_id"]."'>";
	        	//Goes to non editable page
	        	if($row['status'] == 'submitted' || $row['status'] == 'published')
	        		$temp = "<a href='paper.php?paper_id=".$row["paper_id"]."'>";
	            echo "<td>".$temp.$row["title"]."</a></td>";
	            echo "</tr>";
	        }
	        
	     }
	     else
	     {
	        echo "No papers";
	     }
	?>


	</table>




</html>
