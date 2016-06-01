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

if(!Allowed('rooms','update')){
    Header("location: ../access_denied.php");
    exit;
}

?>
<div class="div-cad"> 
<h1>Cadastrar Quarto</h1>

<?php

$number="";
$details="";
$size="";
$value="";
$resid="";

if (isset($_GET['number'])) $number=$_GET['number'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['size'])) $size=$_GET['size'];
if (isset($_GET['value'])) $value=$_GET['value'];
if (isset($_GET['resid'])) $resid=$_GET['resid'];

$readonly="";

if ($_GET['mode']=='update')
    $readonly="readonly";

if (isset($_GET['mes'])){
    if(!strcmp($_GET['mes'],'used_number'))
        echo "<br><center><label class='login_err'>".
        "Número de quarto já existe!</label></center>";
}

echo "<form action='addroom.php' method='POST' enctype='multipart/form-data'>";

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';

echo '<p>Número: <req>*</req> ';
echo '<input type="number" required name="number" '.$readonly.' value="' . $number . '"><br>';

echo '<p>Valor: <req>*</req> ';
echo '<input type="number" step="0.01" required name="value" value="' . $value . '"><br>';

echo '<p>Tamanho: ';
echo '<input type="number" step="0.01" name="size" value="' . $size . '">';

echo '<p>Moradores: <br>';
echo '<textarea name="resid">'.$resid.'</textarea>';

echo '<p>Descrição: <br>';
echo '<textarea name="details">'.$details.'</textarea>';

echo '<hr>';
echo '<p>';
echo '<input class="rooms" type="submit" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

