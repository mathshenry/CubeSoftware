<HTML>
<HEAD>
<TITLE>Usuários</TITLE>
</HEAD>
<BODY  TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<h1>Cadastrar Perfil</h1>
<hr>
<?php

$name="";
$details="";
$profiles="";
$users="";

if (isset($_GET['name'])) $name=$_GET['name'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['profiles'])) $profiles=$_GET['profiles'];
if (isset($_GET['users'])) $users=$_GET['users'];

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_name'))
        echo "Nome de perfil já existe!\n";
}
?>

<form action='addprofile.php' method='POST' enctype='multipart/form-data'>
<?php

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<p>Nome: ';
echo '<input type="text" size="20" name="name" 
    value="' . $name . '">';
echo '<p>Descrição: ';
echo '<input type="text" size="20" name="details"
        value="' . $details . '">';

echo '<p>Permissões: ';
echo '<p><strong>Usuários:</strong>';
echo '<select name="users">';
echo '<option value="read">Leitura</option>';
echo '<option value="write">Escrita/Leitura</option>';
echo '</select>';

echo '<strong>Perfis:</strong>';
echo '<select name="profiles">';
echo '<option value="read">Leitura</option>';
echo '<option value="write">Escrita/Leitura</option>';
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

