<html>
<?php
session_start();
include("head.html");
?>
<basefont SIZE=4>
<H2><STRONG><I> Cadastrar Usuário </I></STRONG></H2>
<P>
<?php

$usr = simplexml_load_file('usuarios.xml');

$user = md5($_POST['user']);
$pass = md5($_POST['pass']);

$exists=false;
if($id_file=file("users_login.dat")){
    for($i=0; $i<count($id_file);$i++){
        if (!strcmp($user, substr($id_file[$i],0,32))){
            $exists=true;
            break;
        }
    }
}

if($exists==false){
    //Adiciona o novo "usuariosenha" no fim do arquivo
    print "Usuário cadastrado com sucesso!\n";
    $id_file=fopen("users_login.dat","a");
    fwrite($id_file, $user . $pass . "\n");
    fclose($id_file);

    $newuser=$usr->addChild('usuario');
    $newuser->addChild('usuario', $_POST['user']);
    $newuser->addChild('nome', $_POST['name']);
    $newuser->addChild('email', $_POST['email']);
    $newuser->addChild('endereco', $_POST['addr']);
    $newuser->addChild('tel', $_POST['tel']);
    $newuser->addChild('perfil', $_POST['perfil']);

    $usr->asXML('usuarios.xml');  

} else {
    print "Usuário já existe!\n";
}
print "<p>" . $_POST['user'] . "<p> \n";
print "<p>" . $_POST['pass'] . "<p> \n";
?>
<p align="left"><a href="showusers.php" target="">Listar Usuários</a></p>
<p align="left"><a href="admin.php" target="">Pagina Inicial</a></p>
</body>
</html>
