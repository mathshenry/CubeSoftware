<?php
session_start();
include("../lib.php");

if(!Allowed('bills', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$bill = $_GET['delete'];

$cad = simplexml_load_file('bills.xml');

#apagar as informacoes de cadastro de conta
foreach($cad->conta as $conta){
    if(!strcmp($bill, strval($conta->id))){
        unset($conta[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('bills.xml');

Header("Location:showbills.php");
?>
