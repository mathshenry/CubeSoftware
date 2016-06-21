<!DOCTYPE html>
<html>

<head>
<link rel='stylesheet' href='../cssstyle.css'>
<title>Contas</title>
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
echo "<h1>Contas</h1><br><br>";
?>
        <table id='bills'>
        <th>Tipo</th>
        <th>Valor</th>
        <th>Vencimento</th>
        <th>Pessoa Responsável</th>
        <th>Situação</th>
        <th>Remover</th>
<?php
$bills = simplexml_load_file('bills.xml');
foreach ($bills->conta as $bill) {
    if(FilterPass("bills", $bill)){
        echo "<tr onclick =\"location.href=
            'billdetails.php?id=". $bill->id . "'\"><td>";
        echo "<b>".strval($bill->tipo) . "</b></td>";
        echo "<td>";
        echo "R$ " . strval($bill->valor) . "</td>";
        echo "<td>";
        echo strval($bill->vencimento) . "</td>";
        echo "<td>";
        echo strval($bill->usuresp) . "</td>";
        echo "<td>";
        echo strval($bill->status) . "</td>";
        echo "<td>";
        echo "<a href='deletebill.php?delete=".$bill->id."'>Remover</td>";
        echo "</tr>";
    }
}
    echo "</table>";
?>
</body>
</html>
