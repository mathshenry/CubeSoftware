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
        
        $cdata=$bill->vencimento;
        $usuresp=$bill->usuresp;

        $can_confirm=false;
        foreach ($users->usuario as $usuario) {
            if(!strcmp($usuario->usuario,$_SESSION['login_user'])){
                if(!strcmp($usuario->perfil,"Administrador") || !strcmp($usuario->nome, $usuresp))
                    $can_confirm=true;
                break;
            }
        }
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

        echo "<div class=col100>";
        echo "<p class='small'>".
        "<div style='float:left;'>" .
        "<H2 class='bills'><STRONG>" .
            strval($bill->titulo) . "</STRONG></H2>";
        echo "<div class=p-p>".strval($bill->tipo)."</div>";
        echo "</p><br>".
            "</div>";

        if (!strcmp($bill->status, "Pendente")){
            echo "<div id='status-div' style='display: ".($can_confirm?"default":"none")."; float:right; cursor:pointer;' onmouseover='hoverconfirm()' onmouseout='hoveroutconfirm()' onclick='clickconfirm(".$bill->id.")''> ";

            $src = "bill-field.svg";
            $label = "<font id='status-label' color='#808080'>Pendente</font>";
            echo "<div style='float:left; height:30px;'><img id='status' class='status' src='".$src."' ></div>";
        } else {
            echo "<div id='status-div' style='float:right;'> ";
            $src = "bill-check.svg";
            $label = "<font id='status-label' color='#5f5ff1'>Quitada</font>";
            echo "<div style='float:left; height:30px;'><img id='status' class='status' src='".$src."'></div>";
        }
        echo "<div style='float:left; padding-left: 6px; width: 100px; height:30px; line-height:30px;'>".$label."</div>";
        echo "</div></p></div>";
 

        echo "<STRONG>Situação: </STRONG> " . 
            "<span id='situacao'>".
            (!strcmp(($bill->status),"Pendente")?"":"Quitada em " .strval($bill->status)).
            "</span>";
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

<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/date.format.js"></script>
<script>
function clickconfirm(id){
    var xhhtp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("situacao").innerHTML = xhttp.responseText;
        }
    };
    var confirmdate = new Date();
    dateFormat.masks.hammerTime = 'dd/mm/yyyy HH:MM"h"';
    
    $.ajax({
        url: '../historys/updatehistory.php',
        type: 'GET',
        dataType: "json",
        data: {
            user: "<?php echo $usuresp ?>",
            expdate: "<?php echo $cdata ?>",
            id: "<?php echo $bill_id ?>",
            mode: 'bill',
            date: confirmdate.format("hammerTime")
        }
    });
    
    xhttp.open("GET", "updatestatus.php?id="+id+"&date="+confirmdate.format("hammerTime"), true);
    xhttp.send();
    
    
    
    var elem = document.getElementById('status-div');
    elem.setAttribute("onclick", "");
    elem.setAttribute("onmouseover", "");
    elem.setAttribute("onmouseout", "");
    elem.setAttribute("style", "float:right; cursor: default;");

    var elem = document.getElementById('status');
    elem.setAttribute("src", "bill-check.svg");
    var elem = document.getElementById('status-label');
    elem.innerHTML="Quitada";
    var elem = document.getElementById('status-label');
    elem.setAttribute("color", "#5f5ff1");

}
function hoverconfirm(){
    var elem = document.getElementById('status');
    elem.setAttribute("src", "bill-hover.svg");
}   
function hoveroutconfirm(){
    var elem = document.getElementById('status');
    elem.setAttribute("src", "bill-field.svg");
}
</script>
