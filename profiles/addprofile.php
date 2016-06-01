<?php

session_start();
include("../lib.php");

if(!Allowed('profiles', 'write')){
    Header("location: ../access_denied.php");
    exit;
}


$profiles = simplexml_load_file('profiles.xml');
if($_POST["mode"]=="create"){

    $exists=false;
    foreach ($profiles->perfil as $perfil) {
        if(!strcmp(strval($perfil->nome), $_POST['name'])){
            $exists=true;
            break;
        }
    }

    if(!$exists){
        //Adiciona info de perfil no arquivo xml
        $newprofile=$profiles->addChild('perfil');
        $newprofile->addChild('nome', $_POST['name']);
        $newprofile->addChild('detalhes', $_POST['details']);
        $newprofile->addChild('usuarios', $_POST['users']);
        $newprofile->addChild('perfis', $_POST['profiles']);
        $newprofile->addChild('contas', $_POST['bills']);
        $newprofile->addChild('quartos', $_POST['rooms']);
        $newprofile->addChild('estoques', $_POST['stocks']);
        $newprofile->addChild('historicos', $_POST['history']);

    } else {
        $mode=$_POST['mode'];
        $redirect = "Location: updateprofile.php?mode=".$mode."&
            mes=used_name&name=".$_POST['name']."&
            details=".$_POST['details']."&
            users=".$_POST['users']."&
            bills=".$_POST['bill']."&
            rooms=".$_POST['rooms']."&
            stocks=".$_POST['stocks']."&
            history=".$_POST['history']."&
            profiles=".$_POST['profiles'];

        Header ($redirect); Exit;
    }
} else {
    foreach ($profiles->perfil as $perfil) {
        if(!strcmp(strval($perfil->nome), $_POST['name'])){
            $perfil->nome=$_POST['name'];
            $perfil->detalhes=$_POST['details'];
            $perfil->usuarios=$_POST['users'];
            $perfil->perfis=$_POST['profiles'];
            $perfil->contas=$_POST['bills'];
            $perfil->quartos=$_POST['rooms'];
            $perfil->estoques=$_POST['stocks'];
            $perfil->historicos=$_POST['history'];
            break;
        }
    }
}

$profiles->asXML('profiles.xml');  
Header("Location:profiledetails.php?detalhes=".$_POST['name']);
?>
