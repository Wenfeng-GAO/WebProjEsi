<?php include('includes/title.inc.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Project Management Platform<?php if(isset($title)) {echo "&#8212;$title";} ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php 
	include('includes/statebar.inc.php'); 
	include('includes/header.inc.php'); 
	include('includes/nav.inc.php');
	include('includes/section.index.inc.php'); 
	include('includes/footer.inc.php'); 
	?>
</body>
</html>