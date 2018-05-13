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

   //Get the names of all auhtors
   $author_sql = "SELECT author_email_address,name,lastname FROM User JOIN Author WHERE author_email_address=email_address";
   $author_result = mysqli_query($conn,$author_sql);
   $paper_id = $_GET['paper_id'];

   if(isset($_POST['uploadpaper']))
   {
   		if(empty($paper_id))
   			uploadpaper($conn);
   		else
   			editpaper($conn,$paper_id);
   }

   if(isset($_POST['submitpaper']))
   {
   		//if paper is not uploaded, first upload, then submit
	   	if(!isset($_POST['uploadpaper']))
	   	{
	   		$paper_id = uploadpaper($conn);
	   	}
	   	else
	   	{
	   		//paper id passed to the link, like this : paper.php?paper_id=20001
	   		$paper_id = $_GET['paper_id'];
	   	}
   		submitpaper($conn,$paper_id);
   }

function editpaper($conn,$paper_id)
{
	if(!empty($_POST['title']))
   	{
   		$title = $_POST['title'];
   		$sql = "UPDATE Paper SET title='$title' WHERE paper_id='$paper_id'";
   		$result = mysqli_query($conn,$sql);
   	}
   	if(!empty($_POST['abstract']))
   	{
   		$abstract = $_POST['abstract'];
   		$sql = "UPDATE Paper SET abstract='$abstract' WHERE paper_id='$paper_id'";
   		$result = mysqli_query($conn,$sql);
   	}
   	$date = date("Y/m/d");
   	$sql = "UPDATE Paper SET date_of_publication='$date' WHERE paper_id='$paper_id'";
   	$result = mysqli_query($conn,$sql);
}

function uploadpaper($conn)
{
	
	if(!empty($_POST['title']))
   	{
   		$title = $_POST['title'];
   	}
   	if(!empty($_POST['abstract']))
   	{
   		$abstract = $_POST['abstract'];
   	}
   	$sql = "SELECT MAX(paper_id) AS max_id FROM Paper";
   	$result = mysqli_query($conn,$sql);
  	$row = mysqli_fetch_array($result);
   	$paper_id = intval($row['max_id']) + 1;
   	$date = date("Y/m/d");
   	$status = 'uploaded';

	//Upload paper
   	$upload_sql = "INSERT INTO Paper(paper_id,title,abstract,date_of_publication,status) VALUES('$paper_id','$title','$abstract','$date','$status')";
   	$upload_result = mysqli_query($conn,$upload_sql);

   	//Add the first author
   	$sql = "INSERT INTO Write_paper VALUES('$email_address','$paper_id')";
	$result = mysqli_query($conn,$sql);
	
	if(!empty($_POST['authors'])){
		//Add the coauthors
		foreach ($_POST['authors'] as $selected_email)
		{
			//Add to Write_paper
			$sql = "INSERT INTO Write_paper VALUES('$selected_email','$paper_id')";
			$result = mysqli_query($conn,$sql);
		
		}
	}

	return $paper_id;
}

function submitpaper($conn,$paper_id)
{
	//Submit to journal only in submit part
	$date = date("Y/m/d");
   	$status = 'submitted';

   	//Add to Submit_to_journal
	$journalISSN = mysqli_real_escape_string($conn,$_POST['journals']);
	$journal_sql = "INSERT INTO Submit_to_journal VALUES('$paper_id','$journalISSN','$date')";
	$journal_result = mysqli_query($conn,$journal_sql);

	//Update status value
	$sql = "UPDATE Paper SET status='submitted' WHERE paper_id='$paper_id'";
	$result = mysqli_query($conn,$sql);

}

?>

<html>
<head>
	<title>Scientific Paper Management System</title>
	<meta charset="UTF-8">
</head>

<body>


<form action="" method="post" name="uploadform">
	<input type="text" placeholder="Title" name="title"/>
	<textarea placeholder="Abstract" name="abstract"></textarea>
	<p>Coauthors:</p>
	<select name="authors[]" multiple>
  	<?php
		$sql = "SELECT * FROM Author JOIN User WHERE author_email_address=email_address AND author_email_address!='$email_address'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result))
		{
			echo '<option value="'.$row['author_email_address'].'">'.$row['name']." ".$row['lastname'].'</option>';
		}
	?>
	</select>
	<p>Journals:</p>
	<select name="journals">
	<?php
  		$sql = "SELECT * FROM Journal";
  		$result = mysqli_query($conn,$sql);
  		while($row = mysqli_fetch_array($result))
  		{
  			echo '<option value="'.$row['ISSN'].'">'.$row['journal_name'].'</option>';
  		}
  	?>
  	</select>
  	<!--Couldn't do upload file part-->
  	<input name="uploadpaper" type = "submit" value = " Upload Paper "/><br />
	<input name="submitpaper" type = "submit" value = " Submit Paper "/><br />

</form>


</html>
