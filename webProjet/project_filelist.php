<?php include('./includes/title.inc.php'); ?>
<?php include 'includes/logout.inc.php';?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Project Management Platform<?php if(isset($title)) {echo "&#8212;$title";} ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>

<body>
	<?php 
	include('includes/statebar.inc.php'); 
	include('includes/header.inc.php'); 
	include('includes/nav.chercheur.inc.php'); 
	 
	?>
</body>
</html>
<?php
include 'includes/connection.inc.php';

if(isset($_GET["project_id"])) {
	$project_id = $_GET["project_id"];
	
	if(isset($_FILES["file"])) {
		echo "hello files";
		if($_FILES['file']['error'] > 0) {
			echo "Error:" .$_FILES["file"]["error"] ."<br>";
		} else {
			// 		echo "Upload:" .$_FILES["file"]["name"] ."<br>";
			// 		echo "Type:" .$_FILES["file"]["type"] ."<br>";
			// 		echo "Size:" .($_FILES["file"]["size"] / 1024 ) ."kB<br>";
			// 		echo "Stored in:" .$_FILES["file"]["tmp_name"]. "<br>";
			echo "<pre>";
			echo print_r($_FILES);
			echo "</pre>";
	
			// create a dictionary and save upload files
			$file_dic = "uploads/$project_id";
			if(!file_exists($file_dic)) {
				mkdir($file_dic, 0777, true);
			}
			$filename = $_FILES["file"]["name"];
			$file_path = $file_dic ."/" .$filename;
			if(file_exists($file_path)) {
				echo $_FILES["file"]["name"] ."already exists. <br>";
			} else {
				$sql_file_insert = "INSERT INTO projects_files (file_name, file_dic, project_id) 
									VALUES ('$filename', '$file_path', '$project_id')";
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_path) && ($link->query($sql_file_insert))) {
					echo "<br>Stored in: $file_path";
				} else {
					echo "Failed to upload file.";
				}
			}
		}
	}
	
	?>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="file">Filename</label> 
		<input type="file" name="file" id="file"><br> 
		<input type="submit" name="submit" value="Upload">
	</form>
	<?php 
	$show_file_name = "";
	$file_uri = "";
	$i = 0;
	$sql_file_select = "SELECT file_name, file_dic FROM projects_files WHERE project_id='$project_id'";
	$result = $link->query($sql_file_select);
	if(!$result) {
		echo "Database connection fail. Please try later.";
	} else {
		while ($row = $result->fetch_assoc()) {
			$show_file_name = $row["file_name"];
			$file_uri = $row["file_dic"];
			$i ++;
			echo "<a href=\"includes/download.inc.php?file_uri=$file_uri&file_name=$show_file_name\"><p>$i. $show_file_name</p></a><br>";
		}
	}
}

include('includes/footer.inc.php');
?>
