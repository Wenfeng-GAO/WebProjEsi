<section class="section">
	<h3>We have 10 projects in total:</h3>
	<?php
	// connect to the database, get the $link variable
	include 'includes/connection.inc.php';
	$result = $link->query ( "SELECT project_id, project_title, project_leader, project_participant_num FROM projects WHERE 1" );
	if (! $result) {
		throw new Exception ( "Database Error" );
	} else {
		while ( $row = $result->fetch_assoc ()) {
			$project_id = $row['project_id'];
			$project_title = $row['project_title'];
			$project_leader = $row['project_leader'];
			$project_participant_num = $row['project_participant_num'];
			printf ( "ID:%d------Title:%s------Leader:%s------Paricipant number:%d <br/>", $project_id, $project_title, $project_leader, $project_participant_num);
			
			
	?>
			<a href="project_detail.php?project_id=<?php echo htmlentities($project_id)?>">
			<div>
				<ul>
					<li>Title : <?php echo $project_title ?></li>
					<li>Chef du projet : <?php echo $project_leader ?></li>
					<li>Nombre des participants : <?php echo $project_participant_num ?></li>
				</ul>
			</div>
			</a>
	<?php		
		}
		
	}
	?>
</section>

