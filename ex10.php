<?php
function calcularMedia($notas) {
    $maior = $notas[0];
    $menor = $notas[0];
    $soma = 0;

    foreach ($notas as $nota) {
        if ($nota > $maior) {
            $maior = $nota;
        }
        if ($nota < $menor) {
            $menor = $nota;
        }
        $soma = $soma + $nota;
    }

    $media = $soma / count($notas);

    if ($media >= 7) {
        $situacao = "Aprovado";
    } elseif ($media >= 5) {
        $situacao = "Recuperacao";
    } else {
        $situacao = "Reprovado";
    }

    echo "Maior nota: $maior <br>";
    echo "Menor nota: $menor <br>";
    echo "Media: $media <br>";
    echo "Situacao: $situacao <br>";
}

$notas = [7.5, 6.0, 8.5, 5.0];
calcularMedia($notas);
?>