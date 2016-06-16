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

$complaint_id=$_GET['id'];
$complaints = simplexml_load_file('complaints.xml');
$users = simplexml_load_file('../users/usuarios.xml');

foreach ($complaints->reclam as $complaint) {
    if(!strcmp(strval($complaint->id),$complaint_id)){

        $nome;
        foreach ($users->usuario as $user) {
            if(!strcmp(strval($user->usuario),
                strval($complaint->usuario))){
                $nome=$user->nome;
                break;
            }
        }
        echo "<h2 class='complaints'><STRONG>" . strval($complaint->assunto) . 
            "</STRONG></h2><br>";
        echo "<p>";
        echo "Por <STRONG>". $nome .": </STRONG>";
        echo "<p>";
        echo "<div number='details' class='p-p'>".
        strval($complaint->detalhes)."</div>";
        echo "<P>";

        echo "<a href='deletecomplaint.php?delete=" . 
            $complaint->id . "'> Apagar Reclamação</a>\n";
        echo "<a href='updatecomplaint.php?mode=update&id="
            . strval($complaint->id) . 
            "&details=" . strval($complaint->detalhes) .
            "&subject=" . strval($complaint->assunto) .
            "'> Editar</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showcomplaints.php" >Listar Reclamações</a></p>
</div>
</body>
</html>
