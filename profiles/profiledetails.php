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

if(!Allowed('profiles', 'read')){
    Header("location: ../access_denied.php");
    exit;
}


echo "<div class=div-body>";

$profilename=$_GET['detalhes'];
$profiles = simplexml_load_file('profiles.xml');

foreach ($profiles->perfil as $profile) {
    if(!strcmp(strval($profile->nome),$profilename)){
        echo ("<H2 class='profiles'><STRONG>" . strval($profile->nome) . 
            "</STRONG></H2>");
        echo("<P>\n");
        echo ("<STRONG><label for='permission'>Descrição: </label></STRONG>" . 
            "<div class='p-p'>".strval($profile->detalhes)).
            "</div>";
        echo("<P>\n");
        echo "<STRONG><label for='permission'>Permissões: </label></STRONG>";
        echo("<div id='permission' class='p-p'>");
        echo "Usuários: " .
            strval($profile->usuarios);
        echo("<P>\n");
        echo ("Perfis: " . 
            strval($profile->perfis));
        echo("<P>\n");
        echo ("Contas: " . 
            strval($profile->contas));
        echo("<P>\n");
        echo ("Quartos: " . 
            strval($profile->quartos));
        echo("<P>\n");
        echo ("Estoque: " . 
            strval($profile->estoques));
        echo("<P>\n");
        echo ("Históricos: " . 
            strval($profile->historicos));
        echo("<P>\n");
            "</div>";
        echo "\t<a href='deleteprofile.php?delete=" . 
            $profile->nome . "' target='principal'> Remover Perfil</a>\n";
        echo "\t<a href='updateprofile.php?mode=update&name="
            . strval($profile->nome) . 
            "&details=" . strval($profile->detalhes) .
            "&users=" . strval($profile->usuarios) .
            "&profiles=" . strval($profile->perfis) .
            "&bills=" . strval($profile->contas) .
            "&rooms=" . strval($profile->quartos) .
            "&stocks=" . strval($profile->estoques) .
            "&history=" . strval($profile->historicos) .
            "'> Editar Perfil</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showprofiles.php" >Listar Perfis</a></p>
</div>
</body>
</html>
