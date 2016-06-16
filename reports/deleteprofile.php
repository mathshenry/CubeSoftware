<?php
session_start();
include("../lib.php");

if(!Allowed('profiles', 'write')){
    Header("location: ../access_denied.php");
    exit;
}


$profile = $_GET['delete'];
if($profile=="Administrador" || $profile=="Morador"){
    Header("location: ../write_profiles_denied.php?mes=O perfil ".$profile." não pode ser removido!");
    exit;
}

$cad = simplexml_load_file('profiles.xml');

#apagar as informacoes de cadastro de perfil
foreach($cad->perfil as $perfil){
    if(!strcmp($profile, strval($perfil->nome))){
        unset($perfil[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('profiles.xml');

Header("Location:showprofiles.php");
?>
