<?php

session_start();
include("../lib.php");

$hist = simplexml_load_file('historys.xml');
$tasks = simplexml_load_file('../tasks/tasks.xml');
$bills = simplexml_load_file('../bills/bills.xml');

$success=false;
foreach ($hist->historico as $history) {
    if(!strcmp(strval($history->usuario), $_GET['user'])){
        $success=true;
        switch ($_GET['mode']){
            case 'task':
                $entry="[".$_GET['date']."]";
                if(datecmp($_GET['expdate'], $_GET['date'])<0)
                    $entry.=" Tarefa cumprida";
                else
                    $entry.=" Tarefa cumprida com atraso";
                
                $history->log->addChild('registro',$entry);
                break;
           case 'bill':
                $entry="[".$_GET['date']."]";
                if(datecmp($_GET['expdate'], substr($_GET['date'],0,10))<=0)
                    $entry.=" Conta quitada";
                else
                    $entry.=" Conta quitada após o vencimento";
                
                $history->log->addChild('registro',$entry);
                break;
 
            default:
        }
    }
} if(!$success){
    addhistory($_GET['user']);
    Header("location: updatehistory.php?user=".$_GET['user']."&id=".$_GET['id']."&date=".$_GET['date']."&mode=".$_GET['mode']);
} else
    $hist->asXML('historys.xml');  

?>
