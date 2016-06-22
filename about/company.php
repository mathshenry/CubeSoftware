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

<div style="clear:both; width: 50%; margin:auto;"></div>

<div id="company2">
	<img src="http://adm-net-a.unifei.edu.br/intranet/arquivos/imagens/logos/LogoEFEItrans.gif" style="width:200px; float:right;margin-right: 15px; margin-top: 30px; margin-bottom: 10px;">

	<h3 style="line-height: 40px; color: black;">
		Universidade Federal de Itajubá<br>
	</h1>

	<p id="description">
		"A Universidade Federal de Itajubá - UNIFEI, fundada em 23 de novembro de 1913, com o nome de Instituto Eletrotécnico e Mecânico de Itajubá - IEMI, por iniciativa pessoal do advogado Theodomiro Carneiro Santiago, foi a décima Escola de Engenharia a se instalar no país."
	<p>

	<div id="descpLink">
		<a href="https://www.unifei.edu.br/" target="_blank">Acesse o site da Universidade</a>
	</div>

</div>

<div style="clear:both; width: 50%; margin:auto;"></div>

<?php
	include("../footnote.html");
?>

</body>
</html>