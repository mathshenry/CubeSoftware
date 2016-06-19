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
echo "<h1>Tarefas</h1><br><br>";
?>
        <table id='tasks'>
        <th>Título</th>
        <th>Vencimento</th>
        <th>Pessoa Responsável</th>
        <th>Situação</th>
        <th>Remover</th>
<?php
$tasks = simplexml_load_file('tasks.xml');
foreach ($tasks->tarefa as $task) {
    if(FilterPass("tasks", $task)){
        echo "<tr onclick =\"location.href=
            'taskdetails.php?id=". $task->id . "'\"><td>";
        echo "<b>".strval($task->titulo) . "</b></td>";
        echo "<td>";
        echo strval($task->cdata) . "</td>";
        echo "<td>";
        echo strval($task->usuresp) . "</td>";
        echo "<td>";
        echo strval($task->status) . "</td>";
        echo "<td>";
        echo "<a href='deletetask.php?delete=".$task->id."'>Remover</td>";
        echo "</tr>";
    }
}
    echo "</table>";
?>
</div>
</body>
</html>
