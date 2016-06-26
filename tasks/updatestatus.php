<?php

$tasks = simplexml_load_file("tasks.xml");

foreach($tasks->tarefa as $task){
    if(!strcmp(strval($task->id),$_GET['id'])){
        $task->status=$_GET['date'];
    }
}
$tasks->asXML('tasks.xml');  
echo "Realizada em ".$_GET['date'];

