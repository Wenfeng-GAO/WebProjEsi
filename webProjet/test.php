<?php
// $filename = "";
// $filepath = "";
// if (isset ( $_GET ["file_uri"] ) && isset ( $_GET ["file_name"] )) {
// 	$filename = $_GET ["file_name"];
// 	$filepath = $_SERVER ["DOCUMENT_ROOT"] . $_GET ["file_uri"];
// }

// if ($filepath) {
	// $filepath = "uploads/CV.pages";
	// echo $_SERVER["DOCUMENT_ROOT"];
// 	echo $filepath;
// 	echo "<br><br>$filename";
	if (file_exists("uploads/2/CV.pages") && is_readable("uploads/2/CV.pages")) {
		// if(file_exists("/Applications/MAMP/htdocsuploads/2")) {
		echo "fuck";
// 		$file = @fopen ( $filepath, "r" );
// 		// get file size and send appropriate headers
// 		$size = filesize ( $filepath );
// 		header ( "Content-Type: application/octet-stream" );
// 		header ( "Content-Length: $size" );
// 		header ( "Content-Disposition: attachment; filename=$filename" );
// 		header ( "Content-Transfer-Encoding: binary" );
// 		if ($file) {
// 			fpassthru ( $file );
// 			exit ();
// 		}
	}
// }
