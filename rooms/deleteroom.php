<?php
session_start();
include("../lib.php");

if(!Allowed('rooms', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$roomnumber = $_GET['delete'];

$cad = simplexml_load_file('rooms.xml');

#apagar as informacoes de cadastro de quarto
foreach($cad->quarto as $quarto){
    if(!strcmp($roomnumber, strval($quarto->numero))){
        unset($quarto[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('rooms.xml');

Header("Location:showrooms.php");
?>
