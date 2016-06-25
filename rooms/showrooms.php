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

if(!Allowed('rooms', 'read')){
    Header("location: ../access_denied.php");
    exit;
}

echo "<div class=div-body>";
echo "<h1>Quartos</h1><hr><br>";

$rooms = simplexml_load_file('rooms.xml');
foreach ($rooms->quarto as $room) {

    echo "<div class=div-q onclick=\"location.href='roomdetails.php?number=".strval($room->numero). "'\">";
    echo "<p class='small'><h4>Quarto ". strval($room->numero) ."</h4><br>";
    echo "<p class='small p-p'>Valor: R$". strval($room->valor) . "</p></p>";
    echo "<p class='small p-p'>Tamanho: " . strval($room->tamanho) . "</p></p>";
    echo "<p class='small p-p'>Moradores: " . strval($room->moradores) . "</p></p>";
    echo "</div><br>";
    }
    echo '<p align=center><a href="showrooms.php">Listar Quartos</a></p>';
    echo "</div>";
?>
</body>
</html>
