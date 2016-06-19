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

if(!Allowed('stocks', 'read')){
    Header("location: ../access_denied.php");
    exit;
}


echo "<div class=div-body>";

$stock_name=$_GET['name'];
$stocks = simplexml_load_file('stocks.xml');

foreach ($stocks->estoque as $stock) {
    if(!strcmp(strval($stock->nome),$stock_name)){
        $itens="";
        foreach($stock->item as $item)
            $itens.=strval($item->nome).', ';
        $itens=trim($itens, ", ");

        echo "<h2 class='stocks'><STRONG>Estoque de " . strval($stock->nome) . 
            "</STRONG></h2><br>";
        echo "<div name='details' class='p-p'>".strval($stock->detalhes)."</div>";
        echo "<p><div style='height:100%;'>";
        echo "<div class='col10'><STRONG>Itens: </STRONG></div>";
        echo "<div class='col90'>";
        foreach($stock->item as $item){
            echo strval($item->nome)."<br>";
        }
        echo "<br></div></div>";
        echo "<div class='col100'><a href='deletestock.php?delete=" . 
            $stock->nome . "'> Remover Estoque</a>\n";
        echo "<a href='updatestock.php?mode=update&name="
            . strval($stock->nome) . 
            "&details=" . strval($stock->detalhes) .
            "&itens=" . $itens .
            "'> Editar Itens</a>\n";
    }
}
?>
<p align=center><a href="showstocks.php" >Listar Estoques</a></p>
</div><br>
</div>
</div>
</body>
</html>
