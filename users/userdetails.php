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
        echo "<a href='../historys/historydetails.php?user=".$usrname."'>Histórico</a>";
        echo "</p><br>";
        echo "<STRONG>Usuário: </STRONG>" . 
            strval($user->usuario);
        echo "<P>";
        echo "<STRONG>E-mail: </STRONG>" . 
            strval($user->email);
        echo "<P>";
        echo "<STRONG>Telefone: </STRONG>" . 
            strval($user->tel);
        echo "<P>";
        echo "<STRONG>Data de Nascimento: </STRONG>" . 
            strval($user->nasc);
        echo "<P>";
        echo "<STRONG>Endereço: </STRONG>";
        echo "<div class=p-p>";
        echo "Logradouro: ". strval($user->endereco);
        echo "<P>";
        echo "CEP: ". $user->cep;
        echo "<P>";
        echo "Cidade/UF: ".$user->cidade;
        echo "</div>";

        if($user->univ!=""){
            echo "<P>";
            echo "<STRONG>Universidade: </STRONG>" . 
            $user->univ;
            echo "<P>";
            echo "<STRONG>Curso: </STRONG>" . 
            $user->curso;
            echo "<P>";
            echo "<STRONG>Nº de Matrícula: </STRONG>" . 
            $user->matricula;

        }
        echo "<P>";
        echo "<a href='updateuser.php?mode=update" .
            "&user=" . strval($user->usuario) .
            "&name=" . strval($user->nome) .
            "&email=" . strval($user->email) .
            "&addr=" . strval($user->endereco) .
            "&tel=" . strval($user->tel) .
            "&birth=" . strval($user->nasc) .
            "&perfil=" . strval($user->perfil) .
            "&city=" . strval($user->cidade) .
            "&cep=" . strval($user->cep) .
            "&univ=" . strval($user->univ) .
            "&course=" . strval($user->curso) .
            "&insnum=" . strval($user->matricula) .
            "'>Alterar</a> ";
        echo "<a href='deleteuser.php?user=" . 
            $user->usuario . "'> Remover Usuário</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showusers.php">Listar Usuários</a></p>
</div>
</body>
</html>
