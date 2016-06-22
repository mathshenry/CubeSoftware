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

<img src="cubeLogo.png" alt="Cube Rep" style="width:50%; margin-top: 80px;margin-left: 25%; border-radius: 30px;box-shadow: 0 0 30px white; ">

<div id="software">

	<p id="softtext">Cub Rep é um softwre desenvolvido pela Cube Software para gerenciamento de república de estudantes.<br>
	Fonnecendo aos usuários controle de estoque, contas, usuários/moradores, tarefas, perfis e reclamações.<br>
	Abaixo, você tem acesso aos links relacionados ao projeto:
	</p>

	<div id="descpLink">
		<a href="Cube-Rep-DRE.pdf" target="_blank">Documento De Requisitos</a><br>
		<a href="https://github.com/mathshenry/CubeSoftware" target="_blank">Repositório GitHub</a>
	</div>

</div>

<?php
	include("../footnote.html");
?>

</body>
</html>