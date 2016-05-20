<html>
<head>
<title>Usuários</title>
</head>
<basefont SIZE=4>
<body TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<H2><STRONG><I>Usuários </I></STRONG></H2>
<P>
<?php

$usr = simplexml_load_file('usuarios.xml');

foreach ($usr->usuario as $user) {
    if(isset($_GET['perfil'])){
        if(!strcmp(strval($usr->perfil),$_GET['perfil'])){
        echo ("<H2><STRONG>" . strval($user->nome) . 
            "</STRONG></H2>");
        echo ("\t" . strval($user->perfil));
        echo("<P>\n");
        echo "<a ref='showusers.php?detalhes=" . 
            $user->usuario . ">detalhes</a>";
        }    
    } else {
        echo ("<STRONG>" . strval($user->nome) . 
            "</STRONG>\t\t" . strval($user->perfil) . "  ");
        echo "\t<a href='userdetails.php?detalhes=" . 
            $user->usuario . "'target=''>detalhes</a>\n";
        echo("<P>\n");
    }
}
?>
<p align="left"><a href="showusers.php" target="">Listar Usuários</a></p>
<p align="left"><a href="admin.php" target="">Pagina Inicial</a></p>
</body>
</html>
