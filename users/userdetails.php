<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
</head>
<body>

<?php
session_start();
include("../lib.php");
include("../head.html");

if(!Allowed('users', 'read')){
    Header("location: ../access_denied.php");
    exit;
}

echo "<div class=div-body>";

$usrname=$_GET['detalhes'];
$usr = simplexml_load_file('usuarios.xml');

foreach ($usr->usuario as $user) {
    if(!strcmp(strval($user->usuario),$usrname)){
        echo "<p class='small'><h2>" . strval($user->nome) . "</h2>";
        echo "<div class=p-p>".strval($user->perfil)."</div>";
        echo "</p><br>";
        echo "<STRONG>Usuário: </STRONG>" . 
            strval($user->usuario);
        echo "<P>\n";
        echo "<STRONG>E-mail: </STRONG>" . 
            strval($user->email);
        echo "<P>\n";
        echo "<STRONG>Endereço: </STRONG>" . 
            strval($user->endereco);
        echo "<P>\n";
        echo "<STRONG>Telefone: </STRONG>" . 
            strval($user->tel);
        echo "<P>\n";
        echo "\t<a href='updateuser.php?mode=update" .
            "&user=" . strval($user->usuario) .
            "&name=" . strval($user->nome) .
            "&email=" . strval($user->email) .
            "&addr=" . strval($user->endereco) .
            "&tel=" . strval($user->tel) .
            "&profile=" . strval($user->perfil) .
            "'>Alterar</a> ";
        echo "<a href='deleteuser.php?delete=" . 
            $user->usuario . "'> Remover Usuário</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showusers.php">Listar Usuários</a></p>
</div>
</body>
</html>
