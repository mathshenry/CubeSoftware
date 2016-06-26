<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
<script src="../js/date.format.js"></script>
<script>
function clickconfirm(id){
    var xhhtp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("situacao").innerHTML = xhttp.responseText;
        }
    };
    var confirmdate = new Date();
    dateFormat.masks.hammerTime = 'dd/mm/yyyy HH:MM"h"';
    xhttp.open("GET", "updatestatus.php?id="+id+"&date="+confirmdate.format("hammerTime"), true);
    xhttp.send();

    var elem = document.getElementById('status-div');
    elem.setAttribute("onclick", "");
    elem.setAttribute("onmouseover", "");
    elem.setAttribute("onmouseout", "");
    elem.setAttribute("style", "float:right; cursor: default;");

    var elem = document.getElementById('status');
    elem.setAttribute("src", "task-check.svg");
    var elem = document.getElementById('status-label');
    elem.innerHTML="Concluída";
    var elem = document.getElementById('status-label');
    elem.setAttribute("color", "#5f5ff1");

}
function hoverconfirm(){
    var elem = document.getElementById('status');
    elem.setAttribute("src", "task-hover.svg");
}   
function hoveroutconfirm(){
    var elem = document.getElementById('status');
    elem.setAttribute("src", "task-field.svg");
}
</script>

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
    
        echo "<div class=col100>".
            "<p class='small'>" .
            "<div style='float:left;'>" .
                    "<H2 class='tasks'><STRONG>" . strval($task->titulo) . 
                    "</STRONG></H2>".
            "</div>";

        if (!strcmp($task->status, "Pendente")){
            echo "<div id='status-div' style='float:right; cursor:pointer;' onmouseover='hoverconfirm()' onmouseout='hoveroutconfirm()' onclick='clickconfirm(".$task->id.")''> ";
            $src = "task-field.svg";
            $label = "<font id='status-label' color='#808080'>Pendente</font>";
            echo "<div style='float:left; height:30px;'><img id='status' class='status' src='".$src."' ></div>";
        } else {
            echo "<div id='status-div' style='float:right;'> ";
            $src = "task-check.svg";
            $label = "<font id='status-label' color='#5f5ff1'>Concluída</font>";
            echo "<div style='float:left; height:30px;'><img id='status' class='status' src='".$src."'></div>";
        }
        echo "<div style='float:left; padding-left: 6px; width: 100px; height:30px; line-height:30px;'>".$label."</div>";
        echo "</div></p></div>";

        echo "<STRONG>Pessoa Responsável: </STRONG>" . 
            strval($task->usuresp);
        echo "<p>";
        echo "<STRONG>Situação: </STRONG> " . 
            "<span id='situacao'>".
            (!strcmp(($task->status),"Pendente")?"":"Realizada em " .strval($task->status)).
            "</span>";
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
