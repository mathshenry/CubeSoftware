<html>
<head>
<title>Novo Perfil</title>
</head>
<basefont SIZE=4>
<body TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<H2><STRONG><I> Cadastrar Perfil </I></STRONG></H2>
<P>
<?php

$profiles = simplexml_load_file('profiles.xml');
if($_POST["mode"]=="create"){

    $exists=false;
    foreach ($profiles->perfil as $perfil) {
        if(!strcmp(strval($perfil->nome), $_POST['name'])){
            $exists=true;
            break;
        }
    }

    if(!$exists){
        //Adiciona info de perfil no arquivo xml
        $newprofile=$profiles->addChild('perfil');
        $newprofile->addChild('nome', $_POST['name']);
        $newprofile->addChild('detalhes', $_POST['details']);
        $newprofile->addChild('usuarios', $_POST['users']);
        $newprofile->addChild('perfis', $_POST['profiles']);


    } else {
        $mode=$_POST['mode'];
        $redirect = "Location: updateprofile.php?mode=".$mode."&
            mes=used_name&name=".$_POST['name']."&
            details=".$_POST['details']."&
            users=".$_POST['users']."&
            profiles=".$_POST['profiles'];

        Header ($redirect);
    }
} else {
    foreach ($profiles->perfil as $perfil) {
        if(!strcmp(strval($perfil->nome), $_POST['name'])){
            $perfil->nome=$_POST['name'];
            $perfil->detalhes=$_POST['details'];
            $perfil->usuarios=$_POST['users'];
            $perfil->perfis=$_POST['profiles'];
        }
    }
}

$profiles->asXML('profiles.xml');  

?>

<p align="left"><a href="showprofiles.php" target="principal">Listar Usuários</a></p>
<p align="left"><a href="admin.php" target="principal">Pagina Inicial</a></p>
</body>
</html>
