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
		<div><h1><?php echo $project_title;?></h1></div>
		<div><p><span>Chef du projet: <b><?php echo $project_leader;?></b></span><br><span>Participants: <b><?php echo $project_participant;?></b></span></div>
		<div><h3>Desciption</h3><br><br><?php echo $project_description;?></div><br>
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
			echo '<form action="">You are already in the groupe.<br><input type="submit" disabled="disabled" value="Participated"></form>';
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
