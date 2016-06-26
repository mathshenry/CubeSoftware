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

if(!Allowed('complaints','update')){
    Header("location: ../access_denied.php");
    exit;
}

?>
<div class="div-cad"> 

<?php
if($_GET['mode']=='update')
    echo "<h1>Alterar Dados</h1>";
else
echo "<h1>Cadastrar Reclamação</h1>";
echo "<hr><br>";

$id="";
$subject="";
$details="";

if (isset($_GET['subject'])) $number=$_GET['subject'];
if (isset($_GET['details'])) $details=$_GET['details'];
if (isset($_GET['id'])) $id=$_GET['id'];

if (isset($_GET['mes'])){
    echo "<br><center><label class='login_err'>".
    strval($_GET['mes'])."</label></center>";
}

echo "<form action='addcomplaint.php' method='POST' enctype='multipart/form-data'>";

echo '<input type="hidden" name="mode" value="' . $_GET['mode'] . '">';
echo '<input type="hidden" name="id" value="' . $id . '">';

echo '<p>Assunto: <req>*</req> ';
echo '<select required name="subject">';

$subjects=array("Geral","Pessoas","Tarefas","Estoques","Contas","Sugestões");
foreach($subjects as $assunto){
    $selected="";
    if($subject==$assunto){
        $selected="selected";
    }
    echo '<option '.$selected.' value="'.$assunto.'">'.$assunto.
        '</option>';
}

echo '</select>';

echo '<p>Reclamação: <br>';
echo '<textarea name="details" maxlength="500">'.$details.'</textarea>';

echo '<hr>';
echo '<p>';
echo '<input class="complaints" type="submit" name="Submit" value="Salvar">';
echo '</p>';
echo '</form>';
echo '</cad></div>';
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>

