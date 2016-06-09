<?php
session_start();
include("../lib.php");

$user = $_GET['user'];

if(!Allowed('users', 'write')){
    Header("location: ../access_denied.php");
    exit;
}

$profile;
$users=simplexml_load_file("usuarios.xml");
foreach($users as $usr){
    if($usr->usuario==$user){
        $profile = $usr->perfil;
        $name = $usr->nome;
        break;
    }
}

if($profile=="Administrador"){
    Header("location: ../delete_admin.php?mes=Usuário administrador não pode ser removido!");
    exit;
}

if(UserHasActiveBill()){
    Header("location: debtor.php?name=".$name);
    exit;
}

$users_file = file("users_login.dat");
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
