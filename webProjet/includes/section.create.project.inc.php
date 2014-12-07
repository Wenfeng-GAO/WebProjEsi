<?php
$title_verify = "";
$create_state = "";
if(isset($_POST['create_project'])) {
	// connection to database
	include 'includes/connection.inc.php';
	if(empty($_POST['project_title'])) {
		$title_verify = "<span>Title can't be blank</span>";
	} else {
		$username = $_SESSION['authenticate2'];
		$title = $_POST['project_title'];
		$description = $_POST['project_description'];
		$sql_insert_project = "INSERT INTO projects (project_title, project_description, project_participant_num, project_leader) VALUES ('$title', '$description', '1', '$username')";
		$sql_insert_participant = "INSERT INTO projects_active (project_title, account_username) VALUES ('$title', '$username')";
		if($link->query($sql_insert_project) && $link->query($sql_insert_participant)) {
			$create_state = 'Project created successfully';
		} else {
			$create_state = 'Failed to create project. Please try later';
		}
	}
}
if(empty($create_state)) {
?>
<section class="section">
	<div id="create_project_form_container">
		<div id="create_project_form_header">
			<h1>Create a new project</h1>
		</div>
		<div id="create_project_form_body">
			<form action="" method="post">
				<label for="project_title"><b>Project title</b></label><br> 
				<input type="text" name="project_title" id="project_title" autofocus="autofocus"><label><?php echo $title_verify; ?></label><br><br> 
				<label for="project_description"><b>Descriptions</b></label><br> 
				<textarea name="project_description" rows="20" cols="100"></textarea> <br>
				<input type="submit" name="create_project" id="create_project" value="Create project">
			</form>
		</div>
	</div>
</section>
<?php 
} else {
?>
<section class="section">
	<div id="project_create_state">
		<h1><?php echo $create_state;?></h1>
	</div>
</section>
<?php
}
?>