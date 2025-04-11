<?php
$capital = isset($_GET['capital']) ? floatval($_GET['capital']) : 0;
$taxa = isset($_GET['taxa']) ? floatval($_GET['taxa']) / 100 : 0;
$anos = isset($_GET['anos']) ? intval($_GET['anos']) : 0;

if ($capital <= 0 || $taxa <= 0 || $anos <= 0) {
    echo "Preencha os campos corretamente.";
    exit;
}

$saldo = $capital;
$ano = 1;

echo "Resultado da simulação";
echo "<pre>";

while ($ano <= $anos) {
    $saldo += $saldo * $taxa;
    echo $ano . "º ano: " . number_format($saldo, 2, ',', '.') . "\n";
    $ano++;
}

echo "</pre>";

echo "<br><a href='index.html'>Limpar</a>";


$nomes = array ("Matheus", "Gabiru")
foreach($nomes as $teste)

echo $teste."<br>"
?>