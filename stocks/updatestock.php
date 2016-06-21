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

if(!Allowed('stocks','update')){
    Header("location: ../access_denied.php");
    exit;
}

?>
<div class="div-cad"> 

<?php
if($_GET['mode']=='update')
    echo "<h1>Alterar Dados</h1><br>";
else
echo "<h1>Cadastrar Estoque</h1>";


$name="";
$details="";
$itens="";

if (isset($_GET['name'])) $name=$_GET['name'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['itens'])) $itens=$_GET['itens'];

$readonly="";

if ($_GET['mode']=='update')
    $readonly="readonly";

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_name'))
        echo "<br><center><label class='login_err'>".
        "Já existe estoque com o mesmo nome!</label></center>";
}

echo "<form action='addstock.php' method='POST' enctype='multipart/form-data'>";

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';

echo '<p>Nome: <req>*</req> ';
echo '<input type="text" required name="name" '.$readonly.' value="' . $name . '"><br>';

echo '<p>Itens: <req>*</req> ';
echo '<input type="text" required name="itens" placeholder="item 1, item 2, item 3..." value="' . $itens . '"><br>';

echo '<p>Descrição: <br>';
echo '<textarea name="details">'.$details.'</textarea>';

echo '<hr>';
echo '<p>';
echo '<input class="stocks" type="submit" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

