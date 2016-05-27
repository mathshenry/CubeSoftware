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
echo "<h1>Usuários</h1><br>";
?>
        <table id='users'>
        <tr>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Perfil</th>
        </tr>
<?php
$usr = simplexml_load_file('usuarios.xml');
foreach ($usr->usuario as $user) {
        echo "<tr onclick =\"location.href=
            'userdetails.php?detalhes=". $user->usuario . "'\"><td>";
        echo "<b>".strval($user->nome) . "</b></td>";
        echo "<td>";
        echo strval($user->usuario) . "</td>";
        echo "<td>";
        echo strval($user->perfil) . "</td>";
        echo "</tr>";
}
    echo "</table>";
?>
</body>
</html>
