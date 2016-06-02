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

if(!Allowed('bills','update')){
    Header("location: ../access_denied.php");
    exit;
}

?>
<div class="div-cad"> 
<h1>Cadastrar Conta</h1>

<?php

$id;
$title="";
$details="";
$received="";
$value="";
$deadline="";
$location="";
$respuser="";
$status="";

if (isset($_GET['id'])) $id=$_GET['id'];
if (isset($_GET['title'])) $title=$_GET['title'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['received'])) $received=$_GET['received'];
if (isset($_GET['value'])) $value=$_GET['value'];
if (isset($_GET['deadline'])) $deadline=$_GET['deadline'];
if (isset($_GET['location'])) $location=$_GET['location'];
if (isset($_GET['respuser'])) $respuser=$_GET['respuser'];
if (isset($_GET['status'])) $status=$_GET['status'];

$paymethods=array('money'=>'Dinheiro','creditcard'=>'Cartão','check'=>'Cheque','billet'=>'Boleto');
$checked=array('money'=>'','creditcard'=>'','check'=>'','billet'=>'');

if($_GET['mode']=='update'){
    if($_GET['money']) $checked['money']='checked';
    if($_GET['creditcard']) $checked['creditcard']='checked';
    if($_GET['check']) $checked['check']='checked';
    if($_GET['billet']) $checked['billet']='checked';
}

$selected_status = array(2);
if($status=="Pendente") $selected_status['p']="selected";
else if($status=="Quitada") $selected_status['q']="selected";

$readonly="";

echo "<form action='addbill.php' method='POST' enctype='multipart/form-data'>";

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';

if ($_GET['mode']=='update'){
    echo '<input type="hidden" name="id" value="' . $id . '">';
}

echo '<p>Título: <req>*</req> ';
echo '<input type="text" required name="title" value="' . $title . '"><br>';

echo '<p>Valor: <req>*</req> ';
echo '<input type="number" step="0.01" required name="value" value="' . $value . '"><br>';

echo '<p>Data de Vencimento: <req>*</req> ';
echo '<input type="date" required name="deadline" value="' . $deadline . '"><br>';
echo '<p>Data de Recebimento: ';
echo '<input type="date" name="received" value="' . $received . '">';

echo '<p>Forma de Pagamento: ';
foreach($paymethods as $pm=>$pmname){
    echo '<input type="checkbox" name="'.$pm.'" '.$checked[$pm].'>'.$pmname." ";
}

echo '<p>Local de Pagamento: ';
echo '<input type="text" name="location" value="' . $location . '"><br>';

echo '<p>Responsável pelo pagamento: <req>*</req>';
echo '<input type="text" required name="respuser" value="' . $respuser . '"><br>';

echo '<p>Descrição: <br>';
echo '<textarea name="details">'.$details.'</textarea>';


echo '<p>Status: <req>*</req> ';
echo '<select name="status">';
echo '<option '.$selected_status['p'].' value="Pendente">Pendente</option>';
echo '<option '.$selected_status['q'].' value="Quitada">Quitada</option>';
echo '</select>';

echo '<hr>';
echo '<p>';
echo '<input class="bills" type="submit" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

