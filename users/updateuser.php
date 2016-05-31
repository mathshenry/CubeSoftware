<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
</head>
<body>

<?php
session_start();
include("../lib.php");
include("../head.html");

if(!Allowed('users', $_GET['mode'])){
    Header("location: ../access_denied.php");
    exit;
}

?>

<div class="div-cad"> 
<h1>Cadastrar</h1>

<?php
$name="";
$user="";
$pass="";
$email="";
$addr="";
$tel="";
$profile="";

if (isset($_GET['name'])) $name=$_GET['name'];
if (isset($_GET['user'])) $user=$_GET['user'];
if (isset($_GET['pass'])) $pass=$_GET['pass'];
if (isset($_GET['email'])) $email=$_GET['email'];
if (isset($_GET['addr'])) $addr=$_GET['addr'];
if (isset($_GET['tel'])) $tel=$_GET['tel'];
if (isset($_GET['profile'])) $profile=$_GET['profile'];

?>
<form action='adduser.php' method='POST' enctype='multipart/form-data'>
<?php

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_login'))
        echo "<center><label class='login_err'>Nome de usuário já existe!</label></center><br>";
}

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<label for="name">Nome: </label>';
echo '<input type="text" required=true id="name" name="name" 
    value="' . $name . '">';
echo '<label for="user">Login: </label>';
if (!strcmp($_GET['mode'],"create")){
    echo '<input type="text" required=true id="user" name="user"
        value="' . $user . '">';
    echo '<label for="pass">Senha: </label>';
    echo '<input type="password" required=true id="pass" name="pass"
        value="' . $pass . '">';
} else {
    echo '<input type="text" id="user" name="user" readonly value="' . $user . '">';
    echo '<p>Senha: ';
    echo "<a href='changepass.php?user=" .
        $user . "'> Alterar</a><br><br>";
}
echo '<label for="email">E-mail: </label>';
echo '<input type="email" required=true id="email" name="email"
    value="' . $email . '">';
echo '<label for="addr">Endereço: </label>';
echo '<input type="text" id="addr" name="addr"
    value="' . $addr . '">';
echo '<label for="tel">Telefone: </label>';
echo '<input type="tel" maxlength="11" id="tel" name="tel"
    value="' . $tel . '">';

echo 'Perfil: <select name="perfil">';

$profiles = simplexml_load_file(
        '../profiles/profiles.xml');
foreach($profiles->perfil as $perfil){
    $selected="";
    if(!strcmp($profile,strval($perfil->nome))){
        $selected="selected";
    }
    echo '<option '.$selected.' value="'.$perfil->nome.'">'.$perfil->nome.
    '</option>';
}
echo '</select>';
echo '<hr>';
echo '<p>';
echo '<input class="users" type="submit" name="Submit" value="Enviar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

