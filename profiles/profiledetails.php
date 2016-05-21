<html>
<head>
<title>Perfis</title>
</head>
<basefont SIZE=4>
<body TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<H2><STRONG><I>Perfis </I></STRONG></H2>
<P>
<?php

$profiles = simplexml_load_file('profiles.xml');

foreach ($profiles->perfil as $profile) {
    if(!strcmp(strval($profile->nome),$_GET['detalhes'])){
        echo ("<H2><STRONG>" . strval($profile->nome) . 
            "</STRONG></H2>");
        echo("<P>\n");
        echo ("<STRONG>Nome: </STRONG>" . 
            strval($profile->nome));
        echo("<P>\n");
        echo ("<STRONG>Detalhes: </STRONG>" . 
            strval($profile->detalhes));
        echo("<P>\n");
        echo "<STRONG>Permissões: </STRONG>";
        echo("<P>\n");
        echo "Usuários: ";
            strval($profile->usuarios);
        echo("<P>\n");
        echo ("Perfis: " . 
            strval($profile->perfis));
        echo("<P>\n");
        echo "\t<a href='deleteprofile.php?delete=" . 
            $profile->nome . "' target='principal'> Remover Perfil</a>\n";
        echo "\t<a href='updateprofile.php?mode=update&profile="
            . strval($profile->nome) . 
            "&details=" . strval($profile->detalhes) .
            "&users=" . strval($profile->usuarios) .
            "&profiles=" . strval($profile->perfis) .
            "' target='principal'> Editar Perfil</a>\n";
    }
}
?>
<P\n>
<p align="left"><a href="showprofiles.php" target="">Listar Usuários</a></p>
<p align="left"><a href="../admin.php" target="">Pagina Inicial</a></p>
</body>
</html>
