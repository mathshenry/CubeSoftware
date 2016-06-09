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

if(!Allowed('profiles','update')){
    Header("location: ../access_denied.php");
    exit;
}

$profile = $_GET['name'];
if ($_GET['mode']=='update' && $profile=="Administrador"){
    Header("location: ../write_profiles_denied.php?mes=O perfil ".$profile." não pode ser alterado!");
    exit;
}

?>
<div class="div-cad"> 
<?php

if($_GET['mode']=='update')
    echo "<h1>Alterar Perfil</h1><br>";
else
echo "<h1>Novo Perfil</h1>";


$name="";
$details="";
$profiles="";
$users="";
$bills="";
$rooms="";
$stocks="";
$history="";

if (isset($_GET['name'])) $name=$_GET['name'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['profiles'])) $profiles=$_GET['profiles'];
if (isset($_GET['users'])) $users=$_GET['users'];
if (isset($_GET['bills'])) $bills=$_GET['bills'];
if (isset($_GET['rooms'])) $rooms=$_GET['rooms'];
if (isset($_GET['stocks'])) $stocks=$_GET['stocks'];
if (isset($_GET['history'])) $history=$_GET['history'];

$selected_user = array(3);
if($users=="-") $selected_bill[0]="selected";
else if($users=="Leitura") $selected_user[1]="selected";
else if($users=="Escrita/Leitura") $selected_user[2]="selected";

$selected_profile = array(3);
if($profiles=="-") $selected_profile[0]="selected";
else if($profiles=="Leitura") $selected_profile[1]="selected";
else if($profiles=="Escrita/Leitura") $selected_profile[2]="selected";

$selected_bill = array(3);
if($bills=="-") $selected_bill[0]="selected";
else if($bills=="Leitura") $selected_bill[1]="selected";
else if($bills=="Escrita/Leitura") $selected_bill[2]="selected";

$selected_room = array(3);
if($rooms=="-") $selected_room[0]="selected";
else if($rooms=="Leitura") $selected_room[1]="selected";
else if($rooms=="Escrita/Leitura") $selected_room[2]="selected";

$selected_stock = array(3);
if($stocks=="-") $selected_stock[0]="selected";
else if($stocks=="Leitura") $selected_stock[1]="selected";
else if($stocks=="Escrita/Leitura") $selected_stock[2]="selected";

$selected_history = array(3);
if($history=="-") $selected_history[0]="selected";
else if($history=="Leitura") $selected_history[1]="selected";
else if($history=="Escrita/Leitura") $selected_history[2]="selected";


$readonly="";

if ($_GET['mode']=='update')
    $readonly="readonly";

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_name'))
        echo "<center><label class='login_err'>".
        "Nome de perfil já existe!</label></center><br>";
}

echo "<form action='addprofile.php' method='POST' enctype='multipart/form-data'>";
echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<p>Nome: <req>*</req>';
echo '<input type="text" required name="name" ' .$readonly.
    ' value="' . $name . '">';
echo '<p>Descrição: <br>';
echo '<textarea name="details">'
         . $details . '</textarea>';

echo '<p>Permissões: ';
echo '<p><strong>Usuários:</strong>';
echo '<select name="users">';
echo '<option '.$selected_user[0].' value="-"></option>';
echo '<option '.$selected_user[1].' value="Leitura">Leitura</option>';
echo '<option '.$selected_user[2].' value="Escrita/Leitura">Escrita/Leitura</option>';
echo '</select>';

echo '<strong>Perfis:</strong>';
echo '<select name="profiles">';
echo '<option '.$selected_profile[0].' value="-"></option>';
echo '<option '.$selected_profile[1].' value="Leitura">Leitura</option>';
echo '<option '.$selected_profile[2].' value="Escrita/Leitura">Escrita/Leitura</option>';
echo '</select>';

echo '<strong>Contas:</strong>';
echo '<select name="bills">';
echo '<option '.$selected_bill[0].' value="-"></option>';
echo '<option '.$selected_bill[1].' value="Leitura">Leitura</option>';
echo '<option '.$selected_bill[2].' value="Escrita/Leitura">Escrita/Leitura</option>';
echo '</select>';

echo '<strong>Quartos:</strong>';
echo '<select name="rooms">';
echo '<option '.$selected_room[0].' value="-"></option>';
echo '<option '.$selected_room[1].' value="Leitura">Leitura</option>';
echo '<option '.$selected_room[2].' value="Escrita/Leitura">Escrita/Leitura</option>';
echo '</select>';

echo '<strong>Estoques:</strong>';
echo '<select name="stocks">';
echo '<option '.$selected_stock[0].' value="-"></option>';
echo '<option '.$selected_stock[1].' value="Leitura">Leitura</option>';
echo '<option '.$selected_stock[2].' value="Escrita/Leitura">Escrita/Leitura</option>';
echo '</select>';

echo '<strong>Histórico:</strong>';
echo '<select name="history">';
echo '<option '.$selected_history[0].' value="-"></option>';
echo '<option '.$selected_history[1].' value="Leitura">Leitura</option>';
echo '<option '.$selected_history[2].' value="Escrita/Leitura">Escrita/Leitura</option>';
echo '</select>';

echo '<hr>';
echo '<p>';
echo '<input type="submit" class="profiles" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

