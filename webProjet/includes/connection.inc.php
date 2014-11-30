<?php
// open a MySQL connection
$link = new mysqli('localhost', 'root', 'root', 'project_esigelec');
if(!$link) {
	die('Connection database failed: ' . $mysqli->error());
}