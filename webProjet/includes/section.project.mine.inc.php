<?php
include 'includes/connection.inc.php';
$username = $_SESSION['authenticate2'];
$sql_my_projects = "SELECT project_title FROM projects_active 
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
			$project = $row['project_title'];
			echo "$project <br>";
		}
	}
}