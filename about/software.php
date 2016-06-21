<!DOCTYPE html>
<html>
<head>
	<title>O Software</title>
	<link rel='stylesheet' href='../cssstyle.css'>
</head>
<body>

<?php
	session_start();
	include("../lib.php");
	include("../head.html");

	if(!Allowed('bills', 'read')){
    	Header("location: ../access_denied.php");
    	exit;
	}
?>

<div>
	
</div>

</body>
</html>