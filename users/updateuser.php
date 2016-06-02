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

echo "<div class="div-cad"> ";

if($_GET['mode']=='update')
    echo "<h1>Alterar Dados</h1><br>";
else
    echo "<h1>Cadastrar</h1><br>";


$name="";
$user="";
$pass="";
$email="";
$birth="";
$city="";
$cep="";
$addr="";
$tel="";
$univ="";
$course="";
$insnum="";
$perfil="";

if (isset($_GET['name'])) $name=$_GET['name'];
if (isset($_GET['user'])) $user=$_GET['user'];
if (isset($_GET['pass'])) $pass=$_GET['pass'];
if (isset($_GET['email'])) $email=$_GET['email'];
if (isset($_GET['birth'])) $birth=$_GET['birth'];
if (isset($_GET['city'])) $city=$_GET['city'];
if (isset($_GET['cep'])) $cep=$_GET['cep'];
if (isset($_GET['addr'])) $addr=$_GET['addr'];
if (isset($_GET['tel'])) $tel=$_GET['tel'];
if (isset($_GET['insnum'])) $insnum=$_GET['insnum'];
if (isset($_GET['univ'])) $univ=$_GET['univ'];
if (isset($_GET['course'])) $course=$_GET['course'];
if (isset($_GET['perfil'])) $profile=$_GET['perfil'];

?>
<form action='adduser.php' method='POST' enctype='multipart/form-data'>
<?php

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_login'))
        echo "<center><label class='login_err'>Nome de usuário já existe!</label></center><br>";
}

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<label for="name">Nome: <req>*</req></label>';
echo '<input type="text" required=true id="name" name="name" 
    value="' . $name . '">';
echo '<label for="user">Login: <req>*</req></label>';
if (!strcmp($_GET['mode'],"create")){
    echo '<input type="text" required=true id="user" name="user"
        value="' . $user . '">';
    echo '<label for="pass">Senha: <req>*</req></label>';
    echo '<input type="password" required=true id="pass" name="pass"
        value="' . $pass . '">';
} else {
    echo '<input type="text" id="user" name="user" readonly value="' . $user . '">';
    echo '<p>Senha: ';
    echo "<a href='changepass.php?user=" .
        $user . "'> Alterar</a><br><br>";
}
echo '<label for="email">E-mail: <req>*</req></label>';
echo '<input type="email" required=true id="email" name="email"
    value="' . $email . '">';

echo 'Perfil: <req>*</req><select name="perfil">';

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

echo '<label for="birth">Data de Nascimento: <req>*</req></label>';
echo '<input type="date" required id="birth" name="birth"
    value="' . $birth . '">';

echo '<label for="city">Cidade/Estado: </label>';
echo '<input type="text" id="city" name="city"
    value="' . $city . '">';

echo '<label for="cep">CEP: </label>';
echo '<input type="text" id="cep" name="cep"
    value="' . $cep . '">';

echo '<label for="addr">Endereço: </label>';
echo '<input type="text" id="addr" name="addr"
    value="' . $addr . '">';

echo '<label for="tel">Telefone: </label>';
echo '<input type="tel" maxlength="11" id="tel" name="tel"
    value="' . $tel . '">';

echo '<hr><br><h4> Para universitários: </h4><br>';

echo '<label for="univ">Universidade: </label>';
echo '<input type="text" id="univ" name="univ"
    value="' . $univ . '">';

echo '<label for="course">Curso: </label>';
echo '<input type="text" id="course" name="course"
    value="' . $course . '">';

echo '<label for="insnum">Nº de Matrícula: </label>';
echo '<input type="number" id="insnum" name="insnum"
    value="' . $insnum . '">';
echo '<hr>';
echo '<p>';
echo '<input class="users" type="submit" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

