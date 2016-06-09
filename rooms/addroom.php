<?php

session_start();
include("../lib.php");

if(!Allowed('rooms', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$rooms = simplexml_load_file('rooms.xml');
$number=$_POST['number'];

if($_POST["mode"]=="create"){

    $exists=false;
    foreach($rooms as $room){
        if($room->numero==$number){
            $exists=true;
            break;
        }
    }
    if(!$exists){
        //Adiciona info de quarto no arquivo xml
        $newroom=$rooms->addChild('quarto');
        $newroom->addChild('numero', $_POST['number']);
        $newroom->addChild('detalhes', $_POST['details']);
        $newroom->addChild('tamanho', $_POST['size']);
        $newroom->addChild('valor', $_POST['value']);
    } else {
        $mode=$_POST['mode'];
        $redirect = "Location: updateroom.php?mode=".$mode.
            "&mes=used_number".
            "&details=".$_POST['details'].
            "&size=".$_POST['size'].
            "&value=".$_POST['value'];

        Header ($redirect); exit;
    }

} else {
    foreach ($rooms->quarto as $quarto) {
        if(!strcmp(strval($quarto->numero), $number)){
            $quarto->numero=$_POST['number'];
            $quarto->detalhes=$_POST['details'];
            $quarto->tamanho=$_POST['size'];
            $quarto->valor=$_POST['value'];
            break;
        }
    }
}

$rooms->asXML('rooms.xml');  
Header("Location:roomdetails.php?number=".$number);
?>
