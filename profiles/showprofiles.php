<html>
<head>
<title>Usuários</title>
</head>
<basefont SIZE=4>
<body TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<H2><STRONG><I>Perfis </I></STRONG></H2>
<P>
<?php

session_start();
if(isset($_SESSION['login_user']))
{
$profiles = simplexml_load_file('profiles.xml');

foreach ($profiles->perfil as $profile) {
        echo "<STRONG>" . strval($profile->nome) . "</STRONG>   ";
        echo "<a href='profiledetails.php?detalhes=" . 
            $profile->nome . "'target='principal'>detalhes</a>\n";
        echo("<P>\n");
    }
}
?>
<p align="left"><a href="showprofiles.php" target="principal">Listar Perfis</a></p>
<p align="left"><a href="admin.php" target="principal">Pagina Inicial</a></p>
</body>
</html>
