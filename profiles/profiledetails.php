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
    if(!strcmp(strval($user->usuario),$_GET['detalhes'])){
        echo ("<H2><STRONG>" . strval($user->nome) . 
            "</STRONG></H2>");
        echo("<P>\n");
        echo ("<STRONG>Usuário: </STRONG>" . 
            strval($user->usuario));
        echo("<P>\n");
        echo ("<STRONG>E-mail: </STRONG>" . 
            strval($user->email));
        echo("<P>\n");
        echo ("<STRONG>Endereço: </STRONG>" . 
            strval($user->endereco));
        echo("<P>\n");
        echo ("<STRONG>Telefone: </STRONG>" . 
            strval($user->tel));
        echo("<P>\n");
        echo "\t<a href='deleteuser.php?delete=" . 
            $user->usuario . "' target='principal'> Remover Usuário</a>\n";
        echo "\t<a href='updateuser.php?mode=update&user="
            . strval($user->usuario) . 
            "&name=" . strval($user->nome) .
            "&addr=" . strval($user->endereco) .
            "&tel=" . strval($user->tel) .
            "&email=" . strval($user->email) .
            "' target='principal'> Editar Informações</a>\n";
    }
}
?>
<P\n>
<p align="left"><a href="showusers.php" target="">Listar Usuários</a></p>
<p align="left"><a href="admin.php" target="">Pagina Inicial</a></p>
</body>
</html>
