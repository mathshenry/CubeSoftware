<HTML>
<HEAD>
<TITLE>Usuários</TITLE>
</HEAD>
<BODY  TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<h1>Cadastrar Usuário</h1>
<hr>
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
<?php

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<p>Nome: ';
echo '<input type="text" size="20" name="name" 
    value="' . $name . '">';
echo '<p>Login: ';
if (!strcmp($_GET['mode'],"create")){
    echo '<input type="text" size="20" name="user"
        value="' . $user . '">';
} else {
    echo '<input type="hidden" name="user"
        value="' . $user . '">';
    echo $user;
}
echo '<p>Senha: ';
if (!strcmp($_GET['mode'],"create")){
    echo '<input type="text" size="20" name="pass"
        value="' . $pass . '">';
} else {
    echo "<a href='changepass.php?user=" .
        $user . "' target='principal'> Alterar senha</a>";
}
echo '<p>E-mail: ';
echo '<input type="text" size="20" name="email"
    value="' . $email . '">';
echo '<p>Endereço: ';
echo '<input type="text" size="20" name="addr"
    value="' . $addr . '">';
echo '<p>Telefone: ';
echo '<input type="text" size="20" name="tel"
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
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

