<?php
session_start();
include("../lib.php");

if(!Allowed('tasks', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$task = $_GET['delete'];

$cad = simplexml_load_file('tasks.xml');

#apagar as informacoes de cadastro de tarefas
foreach($cad->tarefa as $tarefa){
    if(!strcmp($task, strval($tarefa->id))){
        unset($tarefa[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('tasks.xml');

Header("Location:showtasks.php");
?>
