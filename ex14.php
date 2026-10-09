<?php
function estatisticas($numeros) {
    $soma = 0;
    $maior = $numeros[0];
    $menor = $numeros[0];
    $pares = 0;
    $impares = 0;

    foreach ($numeros as $numero) {
        $soma = $soma + $numero;

        if ($numero > $maior) {
            $maior = $numero;
        }
        if ($numero < $menor) {
            $menor = $numero;
        }

        if ($numero % 2 == 0) {
            $pares++;
        } else {
            $impares++;
        }
    }

    $media = $soma / count($numeros);

    // mediana
    sort($numeros);
    $total = count($numeros);
    $meio = intdiv($total, 2);

    if ($total % 2 == 0) {
        $mediana = ($numeros[$meio - 1] + $numeros[$meio]) / 2;
    } else {
        $mediana = $numeros[$meio];
    }

    echo "Soma: $soma <br>";
    echo "Media: $media <br>";
    echo "Maior: $maior <br>";
    echo "Menor: $menor <br>";
    echo "Mediana: $mediana <br>";
    echo "Pares: $pares <br>";
    echo "Impares: $impares <br>";
}

$numeros = [10, 4, 7, 15, 22, 3, 8, 9];
estatisticas($numeros);
?>