<?php
session_start();
include("../lib.php");

if(!Allowed('users', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$users_file = file("users_login.dat");
$user = $_GET['delete'];
$userh = md5($user);

foreach($users_file as $user_key => $usr){
    if(!strcmp($userh, substr($usr,0,32))){
        unset($users_file[$user_key]);
    }
}

$updated_file=fopen("users_login.dat","w");

foreach($users_file as $id){
    fwrite($updated_file, $id);
}
fclose($updated_file);
echo "<p>" . "Done!" . "</p>";

$cad = simplexml_load_file('usuarios.xml');

foreach($cad->usuario as $usuario){
    if(!strcmp($user, strval($usuario->usuario))){
        unset($usuario[0]);
        break;
    }
}
$cad->asXML('usuarios.xml');

header("Location: showusers.php");
?>
