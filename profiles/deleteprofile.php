<?php

$profile = $_GET['delete'];
$profileh = md5($profile);

$cad = simplexml_load_file('profiles.xml');

#apagar as informacoes de cadastro de perfil
foreach($cad->perfil as $perfil){
    if(!strcmp($profile, strval($perfil->nome))){
        unset($perfil[0]);
        break;
    }
}
#atualizar as informacoes de cadastro
$cad->asXML('profiles.xml');

echo "<p>" . "Done!" . "</p>";

?>
