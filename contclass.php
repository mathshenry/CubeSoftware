<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>

<head>
<meta name="FORMATTER" content="Microsoft FrontPage 2.0">
<meta name="GENERATOR" content="Microsoft FrontPage 2.0">
<title>Contents do Classificados</title>
<base target="main">
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#FFFF00"
vlink="#FFFFFF" alink="#FF00FF">

<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>

<p align="center"><a href="showusers.php" target="principal">Listar Usuários</a></p>
<p align="center"><a href="updateuser.php?mode=create" target="principal">Cadastrar Usuário</a></p>

<p align="center"><a href="profiles/showprofiles.php" target="principal">Listar Perfis</a></p>
<p align="center"><a href="profiles/updateprofile.php?mode=create" target="principal">Cadastrar Perfil</a></p>
<p align="center">&nbsp;</p>

<p align="center"><a href="frclass.htm"
target="main">Página Principal</a></p>

<?php

session_start();

if(isset($_SESSION['login_user'])) {
    echo "<center><font color='blue'> " . $_SESSION['login_user'] . "</font></center>";
    echo "<center><font size='2.1'><a href='userdetails.php?detalhes=".$_SESSION["login_user"]."' target='principal'>Meus Dados</a></center></font>";
    echo "<center><font size='2.1'><a href='closesession.php' target='contents'>Sair</a></center></font>";

} else {

$user="";
$pass="";

//Gera o Hash MD5 do login

if (isset($_POST['user']) and $_POST['pass']) {

    $user = md5($_POST['user']);
    $pass = md5($_POST['pass']);
}

//Verifica se os dados do login conferem com algum da relacao de logins ja
//encriptados no arquivo

$success=false;
$users_login=file('users_login.dat', FILE_IGNORE_NEW_LINES);
foreach($users_login as $login){
    if($user . $pass == $login){
        $success=true;
        break;
    }
}
//se sim, exibe a pagina...

if($success)
    {
        $_SESSION['login_user']=$_POST['user'];
        header("Location: contclass.php"); 
    } else {
        ?>
        <form method="POST" action="contclass.php" target="contents">
        <fieldset>
        <?php
        if (isset($_POST['user']) and isset($_POST['pass'])){
            echo "<font size='2.1' color='red'>Usuario/senha incorretos</font>"; 
        } ?>
        <legend>Login</legend>
        <font size="2.1">
        Usuário:  &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp Senha:<br>
        <input type="text" name="user" size="8">&nbsp&nbsp&nbsp<input type="password" name="pass" size="8"><br>

        <div align="right"><input type="submit" name="submit" value="Login" style="height:20px; width:40px; font-size:10">&nbsp</div>

        </font></fieldset>
        </form>
        <?php
    }
}

?>


</body>
</html>
