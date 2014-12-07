<?php
if (isset($_GET['project_id'])) {
	$project_id = $_GET['project_id'];
	$project_title = '';
	$project_leader = '';
	$project_description = '';
	$project_participant = '';
	$project_participant_num = '';
	$is_participated = false;
	
	// connection to database
	include 'includes/connection.inc.php';
	$sql = "SELECT project_title, project_leader, project_description, project_participant_num FROM projects WHERE project_id='$project_id'";
	$sql_participant = "SELECT account_username FROM projects_active JOIN projects USING (project_title) WHERE project_id='$project_id'";
	$result = $link->query($sql);
	$result_participant = $link->query($sql_participant);
	if($result && $result_participant) {
		if($row = $result->fetch_assoc()) {
			$project_title = $row['project_title'];
			$project_leader = $row['project_leader'];
			$project_description = $row['project_description'];
			$project_participant_num = $row['project_participant_num'];
		}
		while($row_participant = $result_participant->fetch_assoc()) {
			if($_SESSION['authenticate2'] == htmlentities($row_participant['account_username'])) {
				$is_participated = true;
			}
			$project_participant .= (" ".$row_participant['account_username']);
		}
	}
// 	echo $project_title . "<br>";
// 	echo $project_validity . "<br>";
// 	echo $project_leader. "<br>";
// 	echo $project_participant. "<br>";
// 	echo $project_description. "<br>";
	?>
	<section class="section">
		<div id="project_detail_title_container"><h1><?php echo $project_title;?></h1></div>
		<div id="project_detail_member_container"><div>Chef du projet: <span><?php echo $project_leader;?></span></div><div>Participants: <span><?php echo $project_participant;?></span></div></div>
		<div id="project_detail_description_container"><h3><span>Desciption</span></h3><div id="project_detail_description"><?php echo $project_description;?></div></div>
		<?php 
		if(isset($_POST['participate'])) {
			$project_username = $_SESSION['authenticate2'];
			$project_num = $project_participant_num + 1;
			$sql_insert_user = "INSERT INTO projects_active (project_title, account_username) VALUES ('$project_title', '$project_username')";
			$sql_insert_num = "UPDATE projects SET project_participant_num = '$project_num' WHERE project_id = '$project_id'";
			if ( $link->query($sql_insert_user) && $link->query($sql_insert_num)) {
				$is_participated = true;
			}
		}
		if($is_participated) {
			echo '<form action=""><input type="submit" name="participated" disabled="disabled" value="Participated"><span id="participate_state">You are already in the groupe</span></form>';
		} else {
			
		?>
		<form action="" method="post">
			<input type="submit" name="participate" value="Participate" >
		</form>
		<?php 
		}
		?>
		
	</section>
	
	<?php 
	
} else {
	echo "Ce projet est en vacance.";
}
?>
