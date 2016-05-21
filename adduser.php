<html>
<head>
<title>Novo Usuário</title>
</head>
<basefont SIZE=4>
<body TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<H2><STRONG><I> Cadastrar Usuário </I></STRONG></H2>
<P>
<?php

$usr = simplexml_load_file('usuarios.xml');
if($_POST["mode"]=="create"){

    $user = md5($_POST['user']);
    $pass = md5($_POST['pass']);

    //confere se nome de usuario ja esta em uso
    $exists=false;
    if($id_file=file("users_login.dat")){
        for($i=0; $i<count($id_file);$i++){
            if (!strcmp($user, substr($id_file[$i],0,32))){
                $exists=true;
                break;
            }
        }
    }

    if(!$exists){
        //Adiciona o novo "usuariosenha" no fim do arquivo
        print "Usuário cadastrado com sucesso!\n";
        $id_file=fopen("users_login.dat","a");
        fwrite($id_file, $user . $pass . "\n");
        fclose($id_file);

        //Adiciona info de cadastro no arquivo xml
        $newuser=$usr->addChild('usuario');
        $newuser->addChild('usuario', $_POST['user']);
        $newuser->addChild('nome', $_POST['name']);
        $newuser->addChild('email', $_POST['email']);
        $newuser->addChild('endereco', $_POST['addr']);
        $newuser->addChild('tel', $_POST['tel']);
        $newuser->addChild('perfil', $_POST['perfil']);


    } else {
        $mode=$_POST['mode'];
        $redirect = "Location: updateuser.php?mode=".$mode."&
            mes=used_login&name=".$_POST['user']."&
            name=".$_POST['name']."&
            email=".$_POST['email']."&
            addr=".$_POST['addr']."&
            tel=".$_POST['tel']."&
            perfil=".$_POST['perfil'];

        Header ($redirect);
    }
} else {
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
}

$usr->asXML('usuarios.xml');  

?>

<p align="left"><a href="showusers.php" target="principal">Listar Usuários</a></p>
<p align="left"><a href="admin.php" target="principal">Pagina Inicial</a></p>
</body>
</html>
