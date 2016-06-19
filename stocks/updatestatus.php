<?php

$stocks = simplexml_load_file("stocks.xml");

$output="";
foreach($stocks->estoque as $stock){
    foreach($stock->item as $item){
        if(!strcmp(strval($item->nome),$_GET['item'])){
            $item->status=(intval($item->status)+1)%2;
        }
        if(strval($item->status)=="0") {
            $output .= '- '.strval($item->nome)."<br>";
        }
    }
}
$stocks->asXML('stocks.xml');  
echo $output;

