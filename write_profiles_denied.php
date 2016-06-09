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
<h4> <?php echo $_GET['mes'];?> </h4><br>
<a href='profiles/showprofiles.php'>Listar Perfis</a>
</center>
</div>
</body>
</html>
