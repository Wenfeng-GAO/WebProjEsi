<?php
include 'includes/connection.inc.php';
$username = $_SESSION['authenticate2'];
$sql_my_projects = "SELECT project_title, project_description, project_id FROM projects_active 
					JOIN projects USING (project_title) 
					WHERE account_username = '$username' AND project_participant_num > 1";
$result = $link->query($sql_my_projects);
if(!$result) {
	echo "Database connection failed.";
} else {
	if(empty($result->fetch_assoc())) {
		echo "You have no project valide now.";
	} else {
		while($row = $result->fetch_assoc()) {
			$project_id = $row['project_id'];
			$project_title = $row['project_title'];
			$project_description = $row['project_description'];
// 			echo "$project <br>";
			?>
			<a style="display:block" href="project_filelist.php?project_id=<?php echo $project_id;?>">
			<div class="my_project_container">
				<div><h3><?php echo $project_title;?></h3></div>
				<div><p><?php echo $project_description;?></p></div>
				<div id=<?php echo $project_id;?> ><h4>file # <?php echo $project_id;?></h4></div>
			</div>
			</a>
			
			<?php 
		}
	}
}
?>