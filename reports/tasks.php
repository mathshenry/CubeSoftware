<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


</head>

<body>
<?php
session_start();
include("../lib.php");
include("../head.html");

/*
if(!Allowed('reports', 'read')){
    Header("location: ../access_denied.php");
    exit;
}
*/

load_names(); 

$start="";
$end="";
$respuser="";
$title="Tarefas Concluídas";
if (isset($_GET['respuser'])) $respuser=$_GET['respuser'];
if (isset($_GET['start'])) $start=$_GET['start'];
if (isset($_GET['end'])) $end=$_GET['end'];

$tasks = simplexml_load_file('../tasks/tasks.xml');

$numtarefas=array(0,0,0);
$today=intval(date("YmdHi"));
foreach($tasks->tarefa as $task){
    if(FilterPass("tasks", $task)){
        $expected_date=date_to_val($task->cdata);
        if(!strcmp($task->status, "Pendente")){
            if($expected_date<$today){
                $i=2; 
            } else continue;
        } else {
            $conclusion_date=date_to_val($task->status);
            if($conclusion_date<$expected_date) $i=0;
            else $i=1;
        }
        $numtarefas[$i]++;
    }
}


?>

<div class='div-body'>
<h1>Tarefas</h1><hr><br>

<form name='newtask' action='tasks.php' method='GET' enctype='multipart/form-data'>
<div class="start">
Inicio:<br>
<input type="text" class="calendario" name="start" placeholder="Nenhum" value="<?php echo $start;?> ">
</div>

<div class="end">
Fim:
<input type="text" class="calendario" name="end" placeholder="Nenhum" value="<?php echo $end;?>">
</div>

<div class="tipo">
Pessoa Responsável
<input type="text" name="respuser" id="autocomplete" value="<?php echo $respuser; ?>"><br>
</div>

<div class="submit">
<input class="reports" type="submit" name="Submit" style="width:60px;" value="Ok">
</div>
    <div id="chart-area">
    <canvas id="myChart" id="chart" width='200' height='200'></canvas>
    </div>
<p align=center><a href="../index.php">Página Inicial</a></p>
</div>

<script src="../js/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.js"></script>
<script src="../js/jquery.maskedinput.js"></script>
<script src="../js/date.format.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="../js/jquery.autocomplete.min.js"></script>
<script src="../js/nameslist-autocomplete.js"></script>

<script>
$(function() {
    $(".calendario").datepicker({dateFormat: 'dd/mm/yy'});
    $(".calendario").mask("99/99/9999",{placeholder:""});
});
</script>

<script>
var ctx = document.getElementById("myChart");
var dados = <?php echo json_encode(array_values($numtarefas)); ?>;
var title = "<?php echo $title; ?>";
var data = {
    labels: [
    "Concluídas dentro do prazo",
    "Concluídas fora do prazo",
    "Não concluídas, fora do prazo"
    ],
    datasets: [
    {
        data: dados,
        backgroundColor: [
        "#46A2EB",
        "#FFCE56",
        "#E20000"
        ],
        hoverBackgroundColor: [
        "#50BAFF",
        "#FFDE66",
        "#FA4040"
        ]
    }]
};
var piechart = new Chart(ctx,{
    type: 'doughnut',
    data: data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Tarefas:'
        }
    }
});
</script>

</body>
</html>
