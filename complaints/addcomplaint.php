<?php

session_start();
include("../lib.php");

if(!Allowed('complaints', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$complaints = simplexml_load_file('complaints.xml','SimpleXMLElement',LIBXML_ERR_WARNING);

if(!strcmp($_POST["mode"],"create")){
    $ids=array();
    foreach ($complaints->reclam as $reclam) {
        array_push($ids, intval($reclam->id));
    }   
    sort($ids);

    $id=0;
    foreach($ids as $used_id){
        if($id!=$used_id) break;
        else $id++;
    }
    //Adiciona info de reclamacao no arquivo xml
    $newcomplaint=$complaints->addChild('reclam');
    $newcomplaint->addChild('id', $id);
    $newcomplaint->addChild('usuario', $_SESSION['login_user']);
    $newcomplaint->addChild('assunto', $_POST['subject']);
    $newcomplaint->addChild('detalhes', $_POST['details']);

} else {
    $id = $_POST['id'];
    foreach ($complaints->reclam as $reclam) {
        if(!strcmp(strval($reclam->id), $id)){
            $reclam->assunto=$_POST['subject'];
            $reclam->detalhes=$_POST['details'];
            break;
        }
    }
}

$complaints->asXML('complaints.xml');  
Header("Location:complaintdetails.php?id=".$id);
?>
