<?php
session_start();
if(isset($_SESSION['login_user']))
{
echo "<h2>" . "Gerenciar Usuários" . "</h2>";
?>

<HTML>
<HEAD>
<TITLE>CubeRep - home page</TITLE>
</HEAD>
<BODY  TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<BASEFONT SIZE=4>
<H2><STRONG><I> CubeRep - Home Page </I></STRONG></H2>
<P>
<p align="left"><a href="showusers.php" target="principal">Listar Usuários</a></p>
<p align="left"><a href="updateuser.php?mode=create" target="principal">Cadastrar Usuário</a></p>
</BODY>
</HTML>

<?php

//...se nao, continua na pagina de login
} else {
        echo "<br><center><h4> Precisa efetuar login.</h4></center>";
}
?>
