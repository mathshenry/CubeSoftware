<html>
<?php

session_start();
include("../lib.php");

if(!Allowed('users', $_POST['mode'])){
    Header("location: ../access_denied.php");
    exit;
}


if($_POST['mode']=='create'){

    $userh = md5($_POST['user']);
    $exists=false;
    if($id_file=file("users_login.dat")){
        for($i=0; $i<count($id_file); $i++){
            if (!strcmp($userh, substr($id_file[$i],0,32))){
                $exists=true;
                break;
            }
        }
    }
    if(!$exists){
        $passh = md5($_POST['pass']);
        //Adiciona o novo "usuariosenha" no fim do arquivo
        $id_file=fopen("users_login.dat","a");
        fwrite($id_file, $userh . $passh . "\n");
        fclose($id_file);

        $usr = simplexml_load_file('usuarios.xml');
        $newuser=$usr->addChild('usuario');
        $newuser->addChild('usuario', $_POST['user']);
        $newuser->addChild('nome', $_POST['name']);
        $newuser->addChild('email', $_POST['email']);
        $newuser->addChild('endereco', $_POST['addr']);
        $newuser->addChild('tel', $_POST['tel']);
        $newuser->addChild('perfil', $_POST['perfil']);

        $usr->asXML('usuarios.xml');  
    ?>
        <head>
        <link rel='stylesheet' href='../cssstyle.css'>
        </head>
        <body>
        <div class=div-body>
        <h3>Usuário cadastrado com sucesso!</h3>
        <center><a href="../index.php">Login</a></center>
        </body>
    <?php
    } else {
        header("Location: updateuser.php?mes=used_login".
                "&mode=create".
                "&user=" . $_POST['user'] .
                "&name=" . $_POST['name'] .
                "&email=" . $_POST['email'] .
                "&addr=" . $_POST['addr'] .
                "&tel=" . $_POST['tel'] .
                "&profile=" . $_POST['perfil']);
    }
} else {
    $usr = simplexml_load_file('usuarios.xml');
    foreach ($usr->usuario as $user) {
        if(!strcmp(strval($user->usuario),
            $_POST['user'])){
            $user->nome=$_POST['name'];
            $user->email=$_POST['email'];
            $user->endereco=$_POST['addr'];
            $user->tel=$_POST['tel'];
            $user->perfil=$_POST['perfil'];
        }
    }
    $usr->asXML('usuarios.xml');  
    header("Location: userdetails.php?detalhes=". $_POST['user'] );
}

?>
</html>
