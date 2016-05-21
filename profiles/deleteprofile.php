<?php

$users_file = file("users_login.dat");
$user = $_GET['delete'];
$userh = md5($user);

#apagar registro de usuario e senha
foreach($users_file as $user_key => $usr){
    if(!strcmp($userh, substr($usr,0,32))){
        unset($users_file[$user_key]);
    }
}

$updated_file=fopen("users_login.dat","w");

#atualizar o registro de usuario e senha
foreach($users_file as $id){
    fwrite($updated_file, $id);
}
fclose($updated_file);

$cad = simplexml_load_file('usuarios.xml');

#apagar as informacoes de cadastro
foreach($cad->usuario as $usuario){
    if(!strcmp($user, strval($usuario->usuario))){
        unset($usuario[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('usuarios.xml');

echo "<p>" . "Done!" . "</p>";

?>
