<?php
session_start();
include("../lib.php");

if(!Allowed('complaints', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$complaint_id = $_GET['delete'];

$cad = simplexml_load_file('complaints.xml');

#apagar as informacoes de cadastro de complaints.xml
foreach($cad->reclam as $reclam){
    if(!strcmp($complaint_id, strval($reclam->id))){
        unset($reclam[0]);
        break;
    }
}
#atualizar as informacoes de cadastro de reclamacoes
$cad->asXML('complaints.xml');

Header("Location:showcomplaints.php");
?>
