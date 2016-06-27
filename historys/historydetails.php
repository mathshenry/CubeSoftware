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

if(!Allowed('historys', 'read')){
    Header("location: ../access_denied.php");
    exit;
}

echo "<div class=div-body>";

$usrname=$_GET['user'];
$usr = simplexml_load_file('../users/usuarios.xml');
$hist = simplexml_load_file('historys.xml');

foreach ($usr->usuario as $user) {
    if(!strcmp(strval($user->usuario),$usrname)){
        echo "<p class='small'><h1>Histórico</h1>";
        echo "</p><hr>";
        echo "<STRONG>Nome: </STRONG>" . 
            strval($user->nome);
        echo "<P>";
        echo "<STRONG>Usuário: </STRONG>" . 
            strval($user->usuario);
        echo "<P>";
        echo "<STRONG>E-mail: </STRONG>" . 
            strval($user->email);
        echo "<P>";
        echo "<STRONG>Data de Nascimento: </STRONG>" . 
            strval($user->nasc);
        echo "<P>";
        echo "<hr>";
        echo "<STRONG>Histórico de Atividades: </STRONG>";
        echo "<div class=p-p>";
            foreach($hist->historico as $historico){
                if(!strcmp($historico->usuario,$user->nome)){
                    $log=$historico->log;
                    foreach($log->registro as $reg){
                        echo "<P>";
                        echo strval($reg);
                    }
                }
            }
        echo "</div>";
        echo "<P>";

        echo "<a href='deletehistory.php?user=" . 
            $user->nome . "'> Remover Histórico</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="../users/showusers.php">Listar Usuários</a></p>
</div>
</body>
</html>
