<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="cssstyle.css">
</head>

<?php

$name="";
$user="";
$pass="";
$email="";
$addr="";
$tel="";

if (isset($_GET['name'])) $name=$_GET['name'];
if (isset($_GET['user'])) $user=$_GET['user'];
if (isset($_GET['pass'])) $pass=$_GET['pass'];
if (isset($_GET['email'])) $email=$_GET['email'];
if (isset($_GET['addr'])) $addr=$_GET['addr'];
if (isset($_GET['tel'])) $tel=$_GET['tel'];

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_login'))
        echo "Nome de usuário já existe!\n";
}
?>

<form action='adduser.php' method='POST' enctype='multipart/form-data'>
<cad><div> 
<?php
echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<label for="name">Nome: </label>';
echo '<input type="text" id="name" name="name" 
    value="' . $name . '">';
echo '<label for="user">Login: </label>';
if (!strcmp($_GET['mode'],"create")){
    echo '<input type="text" id="user" name="user"
        value="' . $user . '">';
    echo '<label for="pass">Senha: </label>';
    echo '<input type="password" id="pass" name="pass"
        value="' . $pass . '">';
} else {
    echo '<input type="hidden" name="user"
        value="' . $user . '">';
    echo $user;
    echo '<p>Senha: ';
    echo "<a href='changepass.php?user=" .
        $user . "'> Alterar senha</a>";
}
echo '<label for="email">E-mail: </label>';
echo '<input type="email" id="email" name="email"
    value="' . $email . '">';
echo '<label for="addr">Endereço: </label>';
echo '<input type="text" id="addr" name="addr"
    value="' . $addr . '">';
echo '<label for="tel">Telefone: </label>';
echo '<input type="number" id="tel" name="tel"
    value="' . $tel . '">';

echo 'Perfil: <select name="perfil">';
echo '<option value="morador">Morador</option>';
echo '<option value="hospede">Hóspede</option>';
echo '</select>';
echo '<hr>';
echo '<p>';
echo '<input type="submit" name="Submit" value="Enviar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

