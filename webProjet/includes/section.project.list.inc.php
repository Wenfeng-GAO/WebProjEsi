<section class="section">
	<?php
	// connect to the database, get the $link variable
	include 'includes/connection.inc.php';
	$result = $link->query ( "SELECT project_id, project_title, project_leader, project_participant_num FROM projects WHERE 1" );
	$sql_count = $link->query("SELECT COUNT(project_id) FROM projects");
	if (! ($result && $sql_count)) {
		throw new Exception ( "Database Error" );
	} else {
		if($tmp = $sql_count->fetch_assoc()) {
			$account_number = $tmp['COUNT(project_id)'];
			echo "<h3 id=\"project_list_container\"><span id=\"project_list_title\">We have <span>$account_number</span> projects in total:</span></h3>";
		}
		while ( $row = $result->fetch_assoc ()) {
			$project_id = $row['project_id'];
			$project_title = $row['project_title'];
			$project_leader = $row['project_leader'];
			$project_participant_num = $row['project_participant_num'];
	?>
<a href="project_detail.php?project_id=<?php echo htmlentities($project_id)?>">
	<div id="project_container">
		<div class="project_title">
			<p><span><?php echo $project_title;?></span></p>
		</div>
		<div class="project_leader">
			<p>Chef du projet: <span><?php echo $project_leader;?></span></p>
		</div>
		<div class="project_participant_num">
			<p>Nombre des participants: <span><?php echo $project_participant_num;?></span></p>
		</div>
	</div>
</a>
	<?php		
		}
	}
	?>
	
</section>

