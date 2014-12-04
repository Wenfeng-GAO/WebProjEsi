<?php
$filename = "";
$filepath = "";
if (isset ( $_GET ["file_uri"] ) && isset ( $_GET ["file_name"] )) {
	$filename = $_GET ["file_name"];
	$filepath = "../". $_GET ["file_uri"];
}
if ($filepath) {
// 	echo $filepath ."<br>";
	if (file_exists($filepath) && is_readable($filepath)) {
		$file = @fopen ( $filepath, "r" );
		// get file size and send appropriate headers
		$size = filesize ( $filepath );
		header ( "Content-Type: application/octet-stream" );
		header ( "Content-Length: $size" );
		header ( "Content-Disposition: attachment; filename=$filename" );
		header ( "Content-Transfer-Encoding: binary" );
		if ($file) {
			fpassthru ( $file );
			exit ();
		}
	}
}
