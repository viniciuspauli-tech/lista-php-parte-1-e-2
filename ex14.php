<?php
function estatisticasNumericas($numeros) {
    if (empty($numeros)) {
        return "O vetor está vazio.";
    }

    $quantidade = count($numeros);
    $soma = array_sum($numeros);
    $media = $soma / $quantidade;
    $maior = max($numeros);
    $menor = min($numeros);
    $mediana = calcularMediana($numeros);

    $pares = 0;
    $impares = 0;
    foreach ($numeros as $numero) {
        if ($numero % 2 === 0) {
            $pares++;
        } else {
            $impares++;
        }
    }

    return [
        'soma'    => $soma,
        'media'   => round($media, 2),
        'maior'   => $maior,
        'menor'   => $menor,
        'mediana' => $mediana,
        'pares'   => $pares,
        'impares' => $impares
    ];
}

// Função auxiliar: calcula a mediana de um vetor de números
function calcularMediana($numeros) {
    $ordenado = $numeros;
    sort($ordenado);
    $quantidade = count($ordenado);
    $meio = (int) floor($quantidade / 2);

    if ($quantidade % 2 === 0) {
        // Quantidade par: média dos dois valores centrais
        return ($ordenado[$meio - 1] + $ordenado[$meio]) / 2;
    }

    // Quantidade ímpar: valor central
    return $ordenado[$meio];
}

// Exemplo de uso
$numeros = [10, 4, 7, 15, 22, 3, 8, 9];
$estatisticas = estatisticasNumericas($numeros);

echo "Soma: " . $estatisticas['soma'] . "\n";
echo "Média: " . $estatisticas['media'] . "\n";
echo "Maior valor: " . $estatisticas['maior'] . "\n";
echo "Menor valor: " . $estatisticas['menor'] . "\n";
echo "Mediana: " . $estatisticas['mediana'] . "\n";
echo "Quantidade de pares: " . $estatisticas['pares'] . "\n";
echo "Quantidade de ímpares: " . $estatisticas['impares'] . "\n";
?>