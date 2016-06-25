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
?>

<div class=div-body>
<h1>Usuários</h1><hr><br>

        <table id='users'>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Perfil</th>
<?php
$usr = simplexml_load_file('usuarios.xml');
foreach ($usr->usuario as $user) {
        echo "<tr onclick =\"location.href=
            'userdetails.php?detalhes=". $user->usuario . "'\">";
        echo "<td><b>" . strval($user->nome) . "</b></td>";
        echo "<td>" . strval($user->usuario) . "</td>";
        echo "<td>" . strval($user->perfil) . "</td>";
        echo "</tr>";
}
?>
</table>
</div>
</body>
</html>
