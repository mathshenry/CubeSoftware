<!DOCTYPE html>
<html>

<?php
session_start();
include("head.html");

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
    $users_login=file('users/users_login.dat', FILE_IGNORE_NEW_LINES);
    foreach($users_login as $login){
        if($user . $pass == $login){
            $success=true;
            break;
        }
    }
    //se sim, exibe a pagina...

    if($success){
        $_SESSION['login_user']=$_POST['user'];
        $redirect="index.php";
        if(isset($_GET['redirect']))
            $redirect=$_GET['redirect'];
        header("Location: " . $redirect); 
    } else {
        ?>
        <div class="div-login"> 
        <h2>Login</h2><br>
        <form method="POST" action="index.php">

        <?php
        if (isset($_POST['user']) and isset($_POST['pass'])){
            echo "<center><label class='login_err'>" . 
            "Usuário/senha incorretos</label></center><br>"; 
        } ?>
        <input type="text" id="user" name="user" placeholder="Usuário"><br>
        <input type="password" id="pass" name="pass" placeholder="Senha"><br>
        <input type="submit" name="submit" value="Entrar">
        
        </form>
        <center><cad><a href="users/updateuser.php?mode=create">Cadastrar</a></cad></center>
        </login></div>
        <?php
    }
}

?>

</body>
</html>
