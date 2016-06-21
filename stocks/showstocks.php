<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>

<script src="../js/jquery-1.12.4.js"></script>
<script>
function changestatus(name,stat){
    var xhhtp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("missing").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "updatestatus.php?item="+name, true);
    xhttp.send();

    var elem = document.getElementById(name);
    if(elem.getAttribute("src")=="missing.svg")
        elem.setAttribute("src", "check.svg");
    else
        elem.setAttribute("src", "missing.svg");

}
</script>

</head>
<body>

<?php
session_start();
include("../lib.php");
include("../head.html");

if(!Allowed('stocks', 'read')){
    Header("location: ../access_denied.php");
    exit;
}
?>
<div class=div-body>
<h1>Estoques</h1><br><br>

<strong>Estoques: </strong>
<?php 
$stocks = simplexml_load_file('stocks.xml');
foreach ($stocks->estoque as $stock) {
    echo "<a href='stockdetails.php?name=".$stock->nome."'>".$stock->nome."</a> ";
}
?>
<br>
<br>
<div class="itens">

        <table id='stocks'>
        <th>Item</th>
        <th>Estoque</th>
        <th>Disponibilidade</th>

<?php
foreach ($stocks->estoque as $stock) {
    foreach ($stock->item as $item) {
        if(FilterPass("stocks", $stock)){
            echo "<tr>";
            echo "<td><b>".strval($item->nome) . "</b></td>";
            echo "<td><a href='stockdetails.php?name=".
            strval($stock->nome)."'>".strval($stock->nome).
                "</a></td>";?>
            <td style="text-align: center;" onclick='changestatus("<?php echo strval($item->nome);?>")'>
            <?php 
            $stat="";
            if(intval($item->status)==1) 
                $stat ='check.svg';    
            else
                $stat='missing.svg';?> 
            <img id="<?php echo strval($item->nome); ?>" style='cursor: pointer; width:20px;' src="<?php echo $stat; ?>">
            </center></td>
            </tr>
            <?php
        }
    }
} ?>
</table>
</div>
<div class="missing">
<h4> Em falta: </h4>
<h5>
<span id="missing">
<?php

foreach ($stocks->estoque as $stock) {
    foreach ($stock->item as $item) {
        if(intval($item->status)==0){
            echo '- '.strval($item->nome)."<br>";
        }
    }
}
?>
</span></h5>
</div>

</div>
</body>
</html>
