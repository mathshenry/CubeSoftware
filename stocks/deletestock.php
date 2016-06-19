<?php
session_start();
include("../lib.php");

if(!Allowed('stocks', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$stockname = $_GET['delete'];

$cad = simplexml_load_file('stocks.xml');

#apagar as informacoes de cadastro de estoque
foreach($cad->estoque as $estoque){
    if(!strcmp($stockname, strval($estoque->nome))){
        unset($estoque[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('stocks.xml');

Header("Location:showstocks.php");
?>
