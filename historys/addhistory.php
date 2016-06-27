<?php

session_start();
include("../lib.php");

$hist = simplexml_load_file('historys.xml');

$newhistory=$hist->addChild('historico');
$newhistory->addChild('usuario', $_GET['user']);

$newabstract=$newhistory->addChild('resumo');
$newabstract->addChild('contas', 0);
$newabstract->addChild('tarefas', 0);
$newabstract->addChild('reclam', 0);

$newabstract=$newhistory->addChild('log');

$hist->asXML('historys.xml');  

?>
