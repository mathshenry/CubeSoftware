<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
</head>
<body>

<?php
session_start();
include("../lib.php");
include("../head.html");

if(!Allowed('tasks', 'read')){
    Header("location: ../access_denied.php");
    exit;
}


echo "<div class=div-body>";

$task_id=$_GET['id'];
$tasks = simplexml_load_file('tasks.xml');
$users = simplexml_load_file('../users/usuarios.xml');

foreach ($tasks->tarefa as $task) {
    if(!strcmp(strval($task->id),$task_id)){
    
        echo "<p class='small'><H2 class='tasks'><STRONG>" .
            strval($task->titulo) . "</STRONG></H2>";
        echo "</p><br>";
        echo "<STRONG>Pessoa Responsável: </STRONG>" . 
            strval($task->usuresp);
        echo "<p>";
        echo "<STRONG>Situação: </STRONG> " . 
            strval($task->status);
        echo "<p>";
        echo "<STRONG>Data Limite: </STRONG>" . 
            strval($task->cdata);
        echo "<p>";
        echo ("<STRONG><label for='details'>Descrição: </label></STRONG>" . 
            "<div id='details' class='p-p'>".strval($task->detalhes)).
            "</div>";
        echo "<P>";

        echo "<a href='deletetask.php?delete=" . 
            $task->id . "'> Remover Tarefa</a>\n";
        echo "<a href='updatetask.php?mode=update&id="
            . strval($task->id) . 
            "&details=" . strval($task->detalhes) .
            "&title=" . strval($task->titulo) .
            "&data=" . strval($task->cdata) .
            "&respuser=" . strval($task->usuresp) .
            "&status=" . strval($task->status) .
            "'> Editar Tarefa</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showtasks.php" >Listar Tarefas</a></p>
</div>
</body>
</html>
