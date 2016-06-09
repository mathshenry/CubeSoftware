<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
</head>
<body>

<?php
session_start();
include("../head.html");

if(!isset($_SESSION['login_user']))
    header("Location: index.php");
?>

<div class="div-body">
<center>
<h4>Usuário tem contas pendentes: <a href="../bills/showbills.php?respuser=<?php echo $_GET['name']; ?>&status=Pendente">Ver Contas</h4>
</center>
</div>
</body>
</html>
