<?php
session_start();
include("../lib.php");

$user = $_GET['user'];

if(!Allowed('historys', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$hist = simplexml_load_file('historys.xml');
foreach($hist->historico as $historico){
    if(!strcmp($user, strval($historico->usuario))){
        unset($historico[0]);
        break;
    }
}
$hist->asXML('historys.xml');

header("Location:" . $_SERVER['HTTP_REFERER']);
?>
