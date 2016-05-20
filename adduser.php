<HTML>
<HEAD>
<TITLE>Novo Usuário</TITLE>
</HEAD>
<BASEFONT SIZE=4>
<BODY  TEXT="#000000" LINK="#0000ff" bgcolor="#FFFFFF">
<H2><STRONG><I> Usuário Cadastrado </I></STRONG></H2>
<P>
<?php

$user = md5($_GET['user']);
$pass = md5($_GET['pass']);

$exists=false;
if($id_file=file("users_login.dat")){
    for($i=0; $i<count($id_file);$i++){
        if (!strcmp($user, substr($id_file[$i],0,32))){
            $exists=true;
            print "user:" . substr($id_file[$i],0,32);
            break;
        }
    }
}

if($exists==false){
    //Adiciona o novo "usuariosenha" no fim do arquivo
    $id_file=fopen("users_login.dat","a");
    fwrite($id_file, $user . $pass . "\n");
    fclose($id_file);
} else {
    print "Usuário já existe!\n";
}
//Escreve o anúncio na arquivo corresponde à categoria deste
print "<p>" . $_GET['username'] . "<p> \n";
print "<p>" . $_GET['pass'] . "<p> \n";
?>
<p align="left"><a href="admin.php" target="">Pagina Inicial</a></p>
</BODY>
</HTML>
