<?php

session_start();
include("../lib.php");

if(!Allowed('bills', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$bills = simplexml_load_file('bills.xml');
if($_POST["mode"]=="create"){
    $ids=array();
    foreach ($bills->conta as $conta) {
        array_push($ids, $conta->id);
    }
    sort($ids);

    $id=0;
    foreach($ids as $used_id){
        if($id!=$used_id) break;
        else $id++;
    }

    //Adiciona info de conta no arquivo xml
    $newbill=$bills->addChild('conta');
    $newbill->addChild('id', $id);
    $newbill->addChild('titulo', $_POST['title']);
    $newbill->addChild('detalhes', $_POST['details']);
    $newbill->addChild('recebimento', $_POST['received']);
    $newbill->addChild('vencimento', $_POST['deadline']);
    $newbill->addChild('valor', $_POST['value']);
    $newbill->addChild('local', $_POST['location']);
    $newbill->addChild('usuresp', $_POST['respuser']);
    $newbill->addChild('status', $_POST['status']);
    $newbill->addChild('formapag');
    $newbill->formapag->addChild(
            'dinheiro', strval(isset($_POST['money'])));
    $newbill->formapag->addChild(
            'cartao', strval(isset($_POST['creditcard'])));
    $newbill->formapag->addChild(
            'cheque', strval(isset($_POST['check'])));
    $newbill->formapag->addChild(
            'boleto', strval(isset($_POST['billet'])));

} else {
    foreach ($bills->conta as $conta) {
        $id=$_POST['id'];
        if(!strcmp(strval($conta->id), $id)){
            $conta->titulo=$_POST['title'];
            $conta->detalhes=$_POST['details'];
            $conta->recebimento=$_POST['received'];
            $conta->vencimento=$_POST['deadline'];
            $conta->valor=$_POST['value'];
            $conta->local=$_POST['location'];
            $conta->usuresp=$_POST['respuser'];
            $conta->status=$_POST['status'];
            $conta->formapag->dinheiro=isset($_POST['money']);
            $conta->formapag->cartao=isset($_POST['creditcard']);
            $conta->formapag->cheque=isset($_POST['check']);
            $conta->formapag->boleto=isset($_POST['billet']);
            break;
        }
    }
}

$bills->asXML('bills.xml');  
Header("Location:billdetails.php?id=".$id);
?>
