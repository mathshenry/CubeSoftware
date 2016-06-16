<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='../cssstyle.css'>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"
    ></script>
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

$title="Despesas totais";
if (isset($_GET['tipo']))
    if(strcmp($_GET['tipo'],"Todos"))
        $title="Despesas com ".$_GET['tipo'];

$bills = simplexml_load_file('../bills/bills.xml');

$despesas=array();
foreach($bills->conta as $bill){
    if(FilterPass("bills", $bill)){
        $data=substr(strval($bill->vencimento),6).
            substr(strval($bill->vencimento),3,2);
        if(!isset($despesas[$data])) $despesas[$data]=0.0;
        $despesas[$data]+=floatval($bill->valor);
    }
}
ksort($despesas);
//$datas=array_keys($despesas);
$datas=array();
foreach($despesas as $data=>$despesa){
    array_push($datas,get_month(substr(strval($data),-2)).'/'.substr(strval($data),0,4));
}

?>

<div class='div-body'>
<h1>Despesas</h1><br>

<form name='newbill' action='bills.php' method='GET' enctype='multipart/form-data'>
<div class="start">
Inicio:<br>
<input type="date" style="width:170px;" name="start">
</div>

<div class="end">
Fim:
<input type="date" style="width:170px;" name="end">
</div>

<div class="tipo">
<?php

$billtypes=array("Todos","Aluguel","Luz","Água","Telefone/Internet","Alimentação","Serviços");

echo 'Tipo de despesa: <br>';
echo '<select style="width:128px;" required name="tipo">';
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
<input class="bills" type="submit" name="Submit" style="width:60px;" value="Ok">
</div>
<div>
<canvas id="myChart" id="chart" width="800" height="400"></canvas>
</div>
<p align=center><a href="../index.php">Página Inicial</a></p>
</div>

<script>

//essa seção script pode ir em qqr lugar, nao importa a ordem,
//o grafico ira aparecer onde vc escreveu <canvas ...></canvas>
var ctx = document.getElementById("myChart");
var dados = <?php echo json_encode(array_values($despesas)); ?>;
var rotulos = <?php echo json_encode(array_values($datas)); ?>;
var title = "<?php echo $title; ?>";
var data = {
labels: rotulos,
datasets: [
{
label: title,
backgroundColor: "#E20000",
borderColor: "#E20000",
borderWidth: 1,
hoverBackgroundColor: "#E22222",
hoverBorderColor: "#E22222",
data: dados,
}
]
};
var myPieChart = new Chart(ctx,{
    type: 'bar',
    data: data,
    options: {}
});

</script>

</body>
</html>
