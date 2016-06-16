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
?>

<div class='div-body'>
<h1>Despesas</h1><br>

<?php
/*
if(!Allowed('reports', 'read')){
    Header("location: ../access_denied.php");
    exit;
}
*/

$profiles = simplexml_load_file('profiles.xml');
    
?>

<canvas id="myChart" width="100" height="100"></canvas>
<p align=center><a href="../index.php">Página Inicial</a></p>
</div>

<script>

//essa seção script pode ir em qqr lugar, nao importa a ordem,
//o grafico ira aparecer onde vc escreveu <canvas ...></canvas>
var ctx = document.getElementById("myChart");
var data = {
labels: ["January", "February", "March", "April", "May", "June", "July"],
datasets: [
{
label: "Despesas do mês",
backgroundColor: "#E20000",
borderColor: "#E20000",
borderWidth: 1,
hoverBackgroundColor: "#E22222",
hoverBorderColor: "#E22222",
data: [65, 59, 80, 81, 56, 55, 40],
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
