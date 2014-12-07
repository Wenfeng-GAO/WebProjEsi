<section class="section" id="section_project_file">
<?php
include 'includes/connection.inc.php';
$file_upload_state = "";

if(isset($_GET["project_id"])) {
	$project_id = $_GET["project_id"];
	
	if(isset($_FILES["file"])) {
		if($_FILES['file']['error'] > 0) {
			$file_upload_state = "Failed to upload file";
		} else {
			// create a dictionary and save upload files
			$file_dic = "uploads/$project_id";
			if(!file_exists($file_dic)) {
				mkdir($file_dic, 0777, true);
			}
			$filename = $_FILES["file"]["name"];
			$file_path = $file_dic ."/" .$filename;
			if(file_exists($file_path)) {
				$file_upload_state = "File <span>".$_FILES["file"]["name"] ."</span> already exists";
			} else {
				$sql_file_insert = "INSERT INTO projects_files (file_name, file_dic, project_id) 
									VALUES ('$filename', '$file_path', '$project_id')";
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_path) && ($link->query($sql_file_insert))) {
					$file_upload_state = "File uploaded succesfully";
				} else {
					$file_upload_state = "Failed to upload file";;
				}
			}
		}
	}

	$show_file_name = "";
	$file_uri = "";
	$i = 0;
	$sql_file_select = "SELECT file_name, file_dic FROM projects_files WHERE project_id='$project_id'";
	$result = $link->query($sql_file_select);
	if(!$result) {
		echo "Database connection fail. Please try later.";
	} else {
		echo "<div id=\"project_file_list\">Project files:</div>";
		while ($row = $result->fetch_assoc()) {
			$show_file_name = $row["file_name"];
			$file_uri = $row["file_dic"];
			$i ++;
			echo "<a href=\"includes/download.inc.php?file_uri=$file_uri&file_name=$show_file_name\"><p>$i. $show_file_name</p></a>";
		}
	}
}
?>
	<div id="project_fileupload_state"><?php echo $file_upload_state;?></div>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="file">Choose to upload</label> 
		<input type="file" name="file" id="file"><br> 
		<input type="submit" name="submit" value="Upload">
	</form>
</section>