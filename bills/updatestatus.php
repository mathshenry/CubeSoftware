<?php

$bills = simplexml_load_file("bills.xml");

foreach($bills->conta as $bill){
    if(!strcmp(strval($bill->id),$_GET['id'])){
        $bill->status=$_GET['date'];
    }
}
$bills->asXML('bills.xml');  
echo "Realizada em ".$_GET['date'];

