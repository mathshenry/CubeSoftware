<!DOCTYPE html>
<html>
<head>
	<title>A Empresa</title>
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

<br>

<div id="company"><br>
	<img src="logo.png" style="float:left; padding: 10px;">
	
	<p id="description"><strong>
		Cube Software é uma empresa, fictícia de produção de softwares de auto nivel usando HTML, PHP e Javascript, criada para fins institucionais envolvendo os alunos:</strong></p>

	<div id="descpLink">
		<a href="https://www.facebook.com/brunoflambert" target="_blank"> Bruno Lambert</a><br>
		<a href="https://www.facebook.com/grazyelyhonorato" target="_blank">Graziela Honorato</a><br>
		<a href="https://www.facebook.com/homerobono" target="_blank">Homero Bonomini</a><br>
		<a href="https://www.facebook.com/mathshenry" target="_blank">Matheus Oliveira</a><br>
	</div><br>

</div>


</body>
</html>