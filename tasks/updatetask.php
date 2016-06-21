<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();
include("../lib.php");
include("../head.html");

if(!Allowed('tasks','update')){
    Header("location: ../access_denied.php");
    exit;
}

load_names(); 
?>

<head>
<link rel='stylesheet' href='../cssstyle.css'>

<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery.maskedinput.js"></script>
<script src="../js/jquery.autocomplete.min.js"></script>
<script src="../js/nameslist-autocomplete.js"></script>

<script>
$(function(){
    $("#data").mask("99/99/9999",{placeholder:""});
    $("#recv").mask("99/99/9999",{placeholder:""});
});

</script>
<script>
function validateForm() {
    var nome = document.forms['newtask']['respuser'].value;
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

</head>
<body>

<div class="div-cad"> 
<h1>Cadastrar Tarefa</h1>

<?php

$id;
$title="";
$details="";
$data="";
$respuser="";
$status="";

if (isset($_GET['id'])) $id=$_GET['id'];
if (isset($_GET['title'])) $title=$_GET['title'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['data'])) $data=$_GET['data'];
if (isset($_GET['respuser'])) $respuser=$_GET['respuser'];
if (isset($_GET['status'])) $status=$_GET['status'];

$selected_status = array(2);
if($status=="Pendente") $selected_status['p']="selected";
else if($status=="Realizada") $selected_status['q']="selected";

$readonly="";

echo "<form name='newtask' action='addtask.php' method='POST' 
    onsubmit='return validateForm()' enctype='multipart/form-data'>";


echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';

if ($_GET['mode']=='update'){
    echo '<input type="hidden" name="id" value="' . $id . '">';
}

echo '<p>Título: <req>*</req> ';
echo '<input type="text" required name="title" value="' . $title . '"><br>';

echo '<p>Data Limite <req>*</req> ';
echo '<input type="datetime-local" required name="data" value="' . $data . '"><br>';

echo '<p>Pessoa Responsável: <req>*</req>';
echo '<input type="text" required name="respuser" id="autocomplete" value="' . $respuser . '"><br>';

echo '<p>Descrição: <br>';
echo '<textarea name="details">'.$details.'</textarea>';


echo '<p>Status: <req>*</req> ';
echo '<select name="status">';
echo '<option '.$selected_status['p'].' value="Pendente">Pendente</option>';
echo '<option '.$selected_status['q'].' value="Realizada">Realizada</option>';
echo '</select>';

echo '<hr>';
echo '<p>';
echo '<input class="tasks" type="submit" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

