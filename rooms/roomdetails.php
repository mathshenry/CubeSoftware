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

$room_number=$_GET['number'];
$rooms = simplexml_load_file('rooms.xml');

foreach ($rooms->quarto as $room) {
    if(!strcmp(strval($room->numero),$room_number)){


        echo "<H2 class='rooms'><STRONG>Quarto " . strval($room->numero) . 
            "</STRONG></H2><br>";
        echo "<p>";
        echo "<STRONG>Valor: </STRONG>R$ " . 
            strval($room->valor);
        echo "<p>";
        echo "<STRONG>Tamanho: </STRONG>" . 
            strval($room->tamanho);
        echo "<p>";
        echo "<STRONG>Moradores: </STRONG>" . 
            strval($room->moradores);
        echo("<P>");
        echo ("<STRONG><label for='details'>Descrição: </label></STRONG>" . 
            "<div number='details' class='p-p'>".strval($room->detalhes)).
            "</div>";
        echo "<P>";

        echo "<a href='deleteroom.php?delete=" . 
            $room->numero . "'> Remover Quarto</a>\n";
        echo "<a href='updateroom.php?mode=update&number="
            . strval($room->numero) . 
            "&details=" . strval($room->detalhes) .
            "&value=" . strval($room->valor) .
            "&size=" . strval($room->tamanho) .
            "&resid=" . strval($room->moradores) .
            "'> Editar Quarto</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showrooms.php" >Listar Quartos</a></p>
</div>
</body>
</html>
