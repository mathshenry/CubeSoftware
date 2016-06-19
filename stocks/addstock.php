<?php

session_start();
include("../lib.php");

if(!Allowed('stocks', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$stocks = simplexml_load_file('stocks.xml');
$name=$_POST['name'];

$itens_array=explode(",",$_POST['itens']);
foreach($itens_array as $key=>$item){
    $itens_array[$key]=ltrim(chop($item));
    if($itens_array[$key]=="") unset($itens_array[$key]);
}

if($_POST["mode"]=="create"){

    $exists=false;
    foreach($stocks as $stock){
        if($stock->nome==$name){
            $exists=true;
            break;
        }
    }
    if(!$exists){
        //Adiciona info de estoque no arquivo xml
        $newstock=$stocks->addChild('estoque');
        $newstock->addChild('nome', $_POST['name']);
        $newstock->addChild('detalhes', $_POST['details']);
        foreach($itens_array as $item){
            $newitem=$newstock->addChild('item');
            $newitem->addChild('nome', $item);
            $newitem->addChild('status', 1);
        }
    } else {
        $mode=$_POST['mode'];
        $redirect = "Location: updatestock.php?mode=".$mode.
            "&mes=used_name".
            "&details=".$_POST['details'].
            "&itens=".$_POST['itens'];

        Header ($redirect); exit;
    }

} else {
    $newitens=array();
    $unsetlist=array();
    foreach ($stocks->estoque as $estoque) {
        if(!strcmp(strval($estoque->nome), $name)){
            $estoque->detalhes=$_POST['details'];
            foreach ($estoque->item as $olditem) {
                $keep=false;
                foreach($itens_array as $key=>$newitem){
                    if(!strcmp($olditem->nome,$newitem)){
                        $keep=true; unset($itens_array[$key]);
                    }
                } if(!$keep){
                    $unsetlist[]=$olditem;
                }
            }
            foreach ($unsetlist as $unsetitem) {
                unset($unsetitem[0]);
            }
            foreach ($itens_array as $newentry) {
                $newchild=$estoque->addChild('item');
                $newchild->addChild('nome', $newentry);
                $newchild->addChild('status', 1);
            }
            break;
        }
    }
}

$stocks->asXML('stocks.xml');  
Header("Location:stockdetails.php?name=".$name);
?>
