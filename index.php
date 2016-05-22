<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="cssstyle.css">
</head>

<body>
<menu>
<li><a
href="showusers.php">Listar Usuários</a></li>
<li><a
href="updateuser.php?mode=create">Cadastrar Usuário</a></li>
<li><a
href="profiles/showprofiles.php">Listar Perfis</a></li>
<li><a
href="profiles/updateprofile.php?mode=create" target="principal">Cadastrar Perfil</a></li>

<?php
session_start();

if(isset($_SESSION['login_user'])) {
    echo "<session> " . 
        $_SESSION['login_user'] . 
        "</session>";
    echo "<a href='userdetails.php?detalhes=".
    $_SESSION["login_user"]."' target='principal'>Meus Dados</a></center></font>";
    echo "<center><font size='2.1'><a href='closesession.php' target='contents'>Sair</a></center></font>";
}
?>

</menu>

<?php
if(!isset($_SESSION['login_user'])) {

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
        if($user . $pass == $login){
            $success=true;
            break;
        }
    }
    //se sim, exibe a pagina...

    if($success){
        $_SESSION['login_user']=$_POST['user'];
        $redirect="home.php";
        if(isset($_GET['redirect']))
            $redirect=$_GET['redirect'];
        header("Location: " . $redirect); 
    } else {
        ?>
        <div> 
        <form method="POST" action="contclass.php">

        <?php
        if (isset($_POST['user']) and isset($_POST['pass'])){
            echo "<font size='2.1' color='red'>
            Usuário/senha incorretos</font>"; 
        } ?>
        <label for="user">Usuário:</label><br>

        <input type="text" id="user" name="user" ><br>
        <label for="pass">Senha:</label><br>

        <input type="password" id="pass" name="pass"><br>

        <input type="submit" name="submit" value="Entrar">
        
        </form>
        </div>
        <?php
    }
}

?>

</body>
</html>
