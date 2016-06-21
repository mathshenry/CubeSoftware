<!DOCTYPE html>
<html>
<?php
session_start();
include("../lib.php");
include("../head.html");

if(!Allowed('bills','update')){
    Header("location: ../access_denied.php");
    exit;
}

load_names(); 
?>

<head>
<link rel='stylesheet' href='../cssstyle.css'>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.js"></script>
<script src="../js/jquery.maskedinput.js"></script>
<script src="../js/jquery.autocomplete.min.js"></script>
<script src="../js/nameslist-autocomplete.js"></script>

<script>
function validateForm() {
    var nome = document.forms['newbill']['respuser'].value;
    var exists=false;
    for (var i=0; i<names.length; i++){
        if(nome == names[i]){
            return true;
        }
    }
    alert(nome + " não é morador!");
    return false;
}
</script>

<script>
$(function() {
    $(".calendario").datepicker({dateFormat: 'dd/mm/yy'});
    $(".calendario").mask("99/99/9999",{placeholder:""});
});

</script></head>
<body>

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
$type="";

if (isset($_GET['id'])) $id=$_GET['id'];
if (isset($_GET['title'])) $title=$_GET['title'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['received'])) $received=$_GET['received'];
if (isset($_GET['value'])) $value=$_GET['value'];
if (isset($_GET['deadline'])) $deadline=$_GET['deadline'];
if (isset($_GET['location'])) $location=$_GET['location'];
if (isset($_GET['respuser'])) $respuser=$_GET['respuser'];
if (isset($_GET['status'])) $status=$_GET['status'];
if (isset($_GET['type'])) $type=$_GET['type'];


$paymethods=array('money'=>'Dinheiro','creditcard'=>'Cartão','check'=>'Cheque','billet'=>'Boleto');
$checked=array('money'=>'checked','creditcard'=>'checked','check'=>'checked','billet'=>'checked');

if($_GET['mode']=='update'){
    if(!$_GET['money']) $checked['money']='';
    if(!$_GET['creditcard']) $checked['creditcard']='';
    if(!$_GET['check']) $checked['check']='';
    if(!$_GET['billet']) $checked['billet']='';
}

$selected_status = array(2);
if($status=="Pendente") $selected_status['p']="selected";
else if($status=="Quitada") $selected_status['q']="selected";

$readonly="";

echo "<form name='newbill' action='addbill.php' method='POST' 
    onsubmit='return validateForm()' enctype='multipart/form-data'>";


echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';

if ($_GET['mode']=='update'){
    echo '<input type="hidden" name="id" value="' . $id . '">';
}

echo '<p>Título: <req>*</req> ';
echo '<input type="text" required name="title" value="' . $title . '"><br>';

echo '<p>Tipo de Conta: <req>*</req> ';
echo '<select required name="type">';

$billtypes=array("Outros","Aluguel","Luz","Água","Telefone/Internet","Alimentação","Serviços");
foreach($billtypes as $tipo){
    $selected="";
    if($type==$tipo){
        $selected="selected";
    }
    echo '<option '.$selected.' value="'.$tipo.'">'.$tipo.
        '</option>';
}

echo '</select>';

echo '<p>Dividido Entre: <req>*</req> ';
$profiles=simplexml_load_file("../profiles/profiles.xml");
foreach($profiles->perfil as $p){
    $chkd_p='';
    if($_GET['mode']=='update'){
        if (isset($_GET[strval($p->nome)]))
            $chkd_p='checked';
    } elseif ($p->nome=="Morador")
            $chkd_p='checked';
    echo '<input type="checkbox" name="'.strval($p->nome).'" '.$chkd_p.'>'.strval($p->nome)." ";
}

echo '<p>Valor (R$): <req>*</req> ';
echo '<input type="number" step="0.01" id="value" required name="value" value="' . $value . '"><br>';

echo '<p>Data de Vencimento: <req>*</req> ';
echo '<input type="text" required class="calendario" id="deadline" name="deadline" value="' . $deadline . '"><br>';
echo '<p>Data de Recebimento: ';
echo '<input type="text" class="calendario" id="received" name="received" value="' . $received . '">';

echo '<p>Forma de Pagamento: ';
foreach($paymethods as $pm=>$pmname){
    echo '<input type="checkbox" name="'.$pm.'" '.$checked[$pm].'>'.$pmname." ";
}

echo '<p>Local de Pagamento: ';
echo '<input type="text" name="location" value="' . $location . '"><br>';

echo '<p>Responsável pelo pagamento: <req>*</req>';
echo '<input type="text" required name="respuser" id="autocomplete" value="' . $respuser . '"><br>';

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

