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

if(!Allowed('complaints', 'read')){
    Header("location: ../access_denied.php");
    exit;
}

echo "<div class=div-body>";
echo "<h1>Reclamações</h1><br><br>";

$complaints = simplexml_load_file('complaints.xml');
$users = simplexml_load_file('../users/usuarios.xml');

foreach ($complaints->reclam as $complaint) {
    $nome;
    foreach ($users->usuario as $user) {
        if(!strcmp(strval($user->usuario),strval($complaint->usuario))){
            $nome=strval($user->nome);
            break;
        }
    }
    echo "<div class=div-c onclick=\"location.href='complaintdetails.php?id=".strval($complaint->id). "'\">";
    echo "<p class='small'><h4>". strval($complaint->assunto) . "</h4><br>";
    echo "<p class='small p-p'>Feita por <strong>" . $nome . "</strong></p></p>";
    echo "<p class='small p-p'>" . strval($complaint->detalhes) . "</p></p>";
    echo "</div><br>";
    }
    echo '<p align=center><a href="showcomplaints.php">Listar Reclamações</a></p>';
    echo "</div>";
?>
</body>
</html>
