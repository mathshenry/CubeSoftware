<?php

session_start();
include("../lib.php");

if(!Allowed('tasks', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$tasks = simplexml_load_file('tasks.xml');
$profiles = simplexml_load_file('../profiles/profiles.xml');

if($_POST["mode"]=="create"){
    $ids=array();
    foreach ($tasks->tarefa as $tarefa) {
        array_push($ids, intval($tarefa->id));
    }
    sort($ids);

    $id=0;
    foreach($ids as $used_id){
        if($id!=$used_id) break;
        else $id++;
    }

    //Adiciona info de tarefa no arquivo xml
    $newtask=$tasks->addChild('tarefa');
    $newtask->addChild('id', $id);
    $newtask->addChild('titulo', $_POST['title']);
    $newtask->addChild('detalhes', $_POST['details']);
    $newtask->addChild('cdata', $_POST['data']);
    $newtask->addChild('usuresp', $_POST['respuser']);
    $newtask->addChild('status', $_POST['status']);

} else {
    $id=$_POST['id'];
    foreach ($tasks->tarefa as $tarefa) {
        if(!strcmp(strval($tarefa->id), $id)){
            $tarefa->titulo=$_POST['title'];
            $tarefa->cdata=$_POST['data'];
            $tarefa->detalhes=$_POST['details'];
            $tarefa->usuresp=$_POST['respuser'];
            $tarefa->status=$_POST['status'];
            break;
        }
    }
}

$tasks->asXML('tasks.xml');
Header("Location:taskdetails.php?id=".$id);
?>
