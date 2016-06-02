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

if(!Allowed('bills', 'read')){
    Header("location: ../access_denied.php");
    exit;
}


echo "<div class=div-body>";

$bill_id=$_GET['id'];
$bills = simplexml_load_file('bills.xml');

foreach ($bills->conta as $bill) {
    if(!strcmp(strval($bill->id),$bill_id)){

        $paymethods="";
        if(strval($bill->formapag->dinheiro)==true) $paymethods="Dinheiro";
        if(strval($bill->formapag->cartao)==true){
            if($paymethods!="") $paymethods.=", ";
            $paymethods.="Cartao";
        }
        if(strval($bill->formapag->cheque)==true){
            if($paymethods!="") $paymethods.=", ";
            $paymethods.="Cheque";
        }
        if(strval($bill->formapag->boleto)==true){
            if($paymethods!="") $paymethods.=", ";
            $paymethods.="Boleto";
        }


        echo "<H2 class='bills'><STRONG>" . strval($bill->titulo) . 
            "</STRONG></H2><br>";
        echo "<p>";
        echo "<STRONG>Situação: </STRONG> " . 
            strval($bill->status);
        echo "<p>";
        echo "<STRONG>Valor: </STRONG>R$ " . 
            strval($bill->valor);
        echo "<p>";
        echo "<STRONG>Vencimento: </STRONG>" . 
            strval($bill->vencimento);
        echo "<p>";
        echo "<STRONG>Recebimento: </STRONG>" . 
            strval($bill->recebimento);
        echo "<p>";
        echo "<STRONG>Usuário Responsável: </STRONG>" . 
            strval($bill->usuresp);
        echo "<p>";
        echo "<STRONG>Formas de Pagamento: </STRONG>".$paymethods;
        echo "<p>";
        echo "<STRONG>Local de Pagamento: </STRONG>" . 
            strval($bill->local);
        echo("<P>\n");
        echo ("<STRONG><label for='details'>Descrição: </label></STRONG>" . 
            "<div id='details' class='p-p'>".strval($bill->detalhes)).
            "</div>";
        echo "<P>\n";

        echo "<a href='deletebill.php?delete=" . 
            $bill->id . "'> Remover Conta</a>\n";
        echo "<a href='updatebill.php?mode=update&id="
            . strval($bill->id) . 
            "&details=" . strval($bill->detalhes) .
            "&title=" . strval($bill->titulo) .
            "&received=" . strval($bill->recebimento) .
            "&value=" . strval($bill->valor) .
            "&deadline=" . strval($bill->vencimento) .
            "&location=" . strval($bill->local) .
            "&respuser=" . strval($bill->usuresp) .
            "&status=" . strval($bill->status) .
            "&money=" . strval($bill->formapag->dinheiro) .
            "&creditcard=" . strval($bill->formapag->cartao) .
            "&check=" . strval($bill->formapag->cheque) .
            "&billet=" . strval($bill->formapag->boleto) .
            "'> Editar Conta</a>\n";
    }
}
?>
<br><br>
<p align=center><a href="showbills.php" >Listar Contas</a></p>
</div>
</body>
</html>
