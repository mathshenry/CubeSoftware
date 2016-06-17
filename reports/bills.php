<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="../js/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.js"></script>
<script src="../js/jquery.maskedinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$(function() {
    $(".calendario").datepicker({dateFormat: 'dd/mm/yy'});
    $(".calendario").mask("99/99/9999",{placeholder:""});
});
</script>

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

$start="";
$end="";
$title="Despesas totais";
if (isset($_GET['tipo'])){
    $type=$_GET['tipo'];
    if(strcmp($_GET['tipo'],"Todos"))
        $title="Despesas com ".$_GET['tipo'];
}
if (isset($_GET['start'])) $start=$_GET['start'];
if (isset($_GET['end'])) $end=$_GET['end'];

$bills = simplexml_load_file('../bills/bills.xml');

$despesas=array();
foreach($bills->conta as $bill){
    if(FilterPass("bills", $bill)){
        $data=substr(date_to_val($bill->vencimento),0,6);
        if(!isset($despesas[$data])) $despesas[$data]=0.0;
        $despesas[$data]+=floatval($bill->valor);
    }
}
ksort($despesas);
fill_gaps($despesas);

$datas=array();
foreach($despesas as $data=>$despesa){
    array_push($datas,get_month(substr(strval($data),4,2)).'/'.substr(strval($data),0,4));
}

?>

<div class='div-body'>
<h1>Despesas</h1><br>

<form name='newbill' action='bills.php' method='GET' enctype='multipart/form-data'>
<div class="start">
Inicio:<br>
<input type="text" class="calendario" name="start" placeholder="Nenhum" value="<?php echo $start;?> ">
</div>

<div class="end">
Fim:
<input type="text" class="calendario" name="end" placeholder="Nenhum" value="<?php echo $end;?>">
</div>

<div class="tipo">
<?php

$billtypes=array("Todos","Aluguel","Luz","Água","Telefone/Internet","Alimentação","Serviços");

echo 'Tipo de despesa: <br>';
echo '<select required name="tipo">';
foreach($billtypes as $tipo){
    $selected="";
    if($type==$tipo){
        $selected="selected";
    }
    echo '<option '.$selected.' value="'.$tipo.'">'.$tipo.
        '</option>';
}
?>
</select>
</div>
<div class="submit">
<input class="reports" type="submit" name="Submit" style="width:60px;" value="Ok">
</div>
<div>
<canvas id="myChart" id="chart" width="800" height="400"></canvas>
</div>
<p align=center><a href="../index.php">Página Inicial</a></p>
</div>

<script>

var ctx = document.getElementById("myChart");
var dados = <?php echo json_encode(array_values($despesas)); ?>;
var rotulos = <?php echo json_encode(array_values($datas)); ?>;
var title = "<?php echo $title; ?>";
var data = {
labels: rotulos,
datasets: [
{
label: title,
backgroundColor: "#2f4f4f",
borderColor: "#2f4f4f",
borderWidth: 1,
hoverBackgroundColor: "#4d8080",
hoverBorderColor: "#4d8080",
data: dados,
}
]
};
var myBarChart = new Chart(ctx,{
    type: 'bar',
    data: data,
    options: {
        scaleLabel: function (cost){
            return '$ ' + Number(cost.value);
        }
    }
});

</script>

</body>
</html>
