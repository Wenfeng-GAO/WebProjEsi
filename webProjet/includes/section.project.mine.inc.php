<section class="section">
<?php
include 'includes/connection.inc.php';
$username = $_SESSION['authenticate2'];
$sql_my_projects = "SELECT project_title, project_leader, project_description, project_id FROM projects_active 
					JOIN projects USING (project_title) 
					WHERE account_username = '$username' AND project_participant_num > 1";
$sql_my_project_num = "SELECT COUNT(project_id) FROM projects_active
					   JOIN projects USING (project_title)
					   WHERE account_username = '$username' AND project_participant_num > 1";
$num_result = $link->query($sql_my_project_num);
$result = $link->query($sql_my_projects);
if(! ($result && $num_result)) {
	echo "Database connection failed.";
} else {
	if($tmp = $num_result->fetch_assoc()) {
		$account_number = $tmp['COUNT(project_id)'];
		echo "<h3 id=\"project_mine_list_container\"><span id=\"project_mine_list_title\">You have <span>$account_number</span> projects in progress:</span></h3>";
	}
	while ( $row = $result->fetch_assoc () ) {
		$project_id = $row ['project_id'];
		$project_title = $row ['project_title'];
		$project_leader = $row ['project_leader'];
		$project_description = $row ['project_description'];
	?>
	<a style="display: block" href="project_filelist.php?project_id=<?php echo $project_id;?>">
		<div id="project_mine_big_container">
			<div id="project_mine_container">
				<div id="project_mine_title_container">
					<span><?php echo $project_title;?></span>
				</div>
				<div id="project_mine_leader_container">( <?php echo $project_leader;?> )</div>
			</div>
			<div id="project_mine_description_container">
				<div id="project_mine_description_title">Description</div>
				<div id="project_mine_description"><?php echo $project_description;?></div>
			</div>
		</div>
	</a>
	<?php 
	}
}
?>
</section>