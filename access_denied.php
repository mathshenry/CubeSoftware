<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='cssstyle.css'>
</head>
<body>

<?php
session_start();
include("head.html");

if(!isset($_SESSION['login_user']))
    header("Location: index.php");
?>

<div class="div-body">
<center>
<h4>Você não tem permissão para acessar esse conteúdo!</h4><br>
<a href='closesession.php'>Logar com outro usuário</a>
</center>
</div>
</body>
</html>
