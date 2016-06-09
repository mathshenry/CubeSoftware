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
$profiles = simplexml_load_file('../profiles/profiles.xml');
$users = simplexml_load_file('../users/usuarios.xml');

foreach ($bills->conta as $bill) {
    if(!strcmp(strval($bill->id),$bill_id)){
    
        $payers="";
        foreach($bill->pagadores->perfil as $pag){
            $payers.=strval($pag).", ";
        }

        $paymethods="";
        if(strval($bill->formapag->dinheiro)==true) $paymethods="Dinheiro";
        if(strval($bill->formapag->cartao)==true){
            if($paymethods!="") $paymethods.=", ";
            $paymethods.="Cartão";
        }
        if(strval($bill->formapag->cheque)==true){
            if($paymethods!="") $paymethods.=", ";
            $paymethods.="Cheque";
        }
        if(strval($bill->formapag->boleto)==true){
            if($paymethods!="") $paymethods.=", ";
            $paymethods.="Boleto";
        }

        echo "<p class='small'><H2 class='bills'><STRONG>" .
            strval($bill->titulo) . "</STRONG></H2>";
        echo "<div class=p-p>".strval($bill->tipo)."</div>";
        echo "</p><br>";
        echo "<STRONG>Situação: </STRONG> " . 
            strval($bill->status);
        echo "<p>";
        echo "<STRONG>Valor: </STRONG>";
        
        $n=0;
        foreach($users->usuario as $usr){
            foreach ($bill->pagadores->perfil as $p){
                if(strval($usr->perfil)==strval($p)){
                    $n++;
                    break;
                }
            }
        }
        if(!$n) $n=1;

        echo("<div id='value' class='p-p'>");
        echo "Individual: R$ " .
            number_format((float)$bill->valor/$n,2,'.','') .
            " (".$n." pessoas)";
        echo "<P>\n";
        echo "Total: R$ " . strval($bill->valor);
        echo "<P></div>";

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
        echo "<STRONG>Dividida Entre: </STRONG>" . $payers;
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
            "&type=" . strval($bill->tipo) .
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
