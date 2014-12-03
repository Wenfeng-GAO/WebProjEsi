<?php
include 'includes/connection.inc.php';

if(isset($_GET["project_id"])) {
echo "hello world!";
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
			$file_path = $file_dic ."/" .$_FILES["file"]["name"];
			if(file_exists($file_path)) {
				echo $_FILES["file"]["name"] ."already exists. <br>";
			} else {
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
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
}
?>