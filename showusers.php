<html>
<?php
session_start();
include("head.html");
?>
<basefont SIZE=4>
<H2><STRONG><I>Usuários </I></STRONG></H2>
<P>
<?php

if(isset($_SESSION['login_user']))
{

$usr = simplexml_load_file('usuarios.xml');

echo "<div class=div-body>";
echo "<h1>Usuários</h1><br>";
?>
        <table id='users'>
        <tr>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Perfil</th>
        <th>Visualizar</th>
        </tr>
<?php
foreach ($usr->usuario as $user) { ?>
        <tr onclick ="location.href='showusers.php'"><td>
            <?php
        echo strval($user->nome) . "</td>";
        echo "<td>";
        echo strval($user->usuario) . "</td>";
        echo "<td>";
        echo strval($user->perfil) . "</td>";
        echo "<td>";
        echo "<a href='showusers.php?detalhes=" . 
            $user->usuario . "'>detalhes</a>";
        echo "</td>";
        echo "</tr>";
}
    echo "</table>";
} else {
    header("Location: index.php");
}
?>
</body>
</html>
