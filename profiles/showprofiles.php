<!DOCTYPE html>
<html>

<?php
session_start();
include("../head.html");

if(isset($_SESSION['login_user'])) {
$profiles = simplexml_load_file('profiles.xml');

echo "<div class='div-body'>";
echo "<h1>Perfis</h1><br>";

foreach ($profiles->perfil as $profile) {
    
    echo "<div class=div-p onclick=\"location.href='profiledetails.php?detalhes="
    .strval($profile->nome). "'\">";
    echo "<p class='small'><h4>". strval($profile->nome) ."</h4>";
    echo "<p class='small p-p'>" . strval($profile->detalhes) . "</p></p>";
    echo "</div><br>";
    }
}
echo '<p align=center><a href="showprofiles.php">Listar Perfis</a></p>';
echo "</div>";
?>
</body>
</html>
