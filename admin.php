<?php

$user="";
$pass="";

//Gera o Hash MD5 do login
if (isset($_POST['user']) and $_POST['pass']) {
	$user = md5($_POST['user']);
	$pass = md5($_POST['pass']);
}
//Verifica se os dados do login conferem com algum da relacao de logins ja
//encriptados no arquivo
$success=false;
$users_login=file('users_login.dat', FILE_IGNORE_NEW_LINES);
foreach($users_login as $login){
    if($user . $pass == trim($login)){
        $success=true;
        break;
    }
}
//se sim, exibe a pagina
if($success)
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
<p align="left"><a href="userform.htm" target="">Cadastrar Usuário</a></p>
</BODY>
</HTML>

<?php

//...se nao, continua na pagina de login
} else {
    echo "<h4>" . "Administrador" . "</h4>";
    if (isset($_POST['user']) and isset($_POST['pass'])){
        echo "<p><font color = 'ff0000'>Usuario/senha incorretos</font><p>";
    }
    ?>
    <form method="POST" action="admin.php">
    Usuário: <input type="text" name="user"><br>
    Senha: <input type="password" name="pass"><br>
    <input type="submit" name="submit" value="Login">
    </form>
    <?php
}
?>
