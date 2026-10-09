<?php
function analisarNumero($numero) {
    $resultado = [];

    // Par ou ímpar
    $resultado['par_impar'] = ($numero % 2 === 0) ? 'Par' : 'Ímpar';

    // Primo ou não
    $resultado['primo'] = ehPrimo($numero) ? 'Primo' : 'Não é primo';

    // Perfeito ou não
    $resultado['perfeito'] = ehPerfeito($numero) ? 'Perfeito' : 'Não é perfeito';

    return $resultado;
}

// Função auxiliar: verifica se um número é primo
function ehPrimo($numero) {
    if ($numero < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i === 0) {
            return false;
        }
    }
    return true;
}

// Função auxiliar: verifica se um número é perfeito
// (a soma de seus divisores próprios é igual ao próprio número)
function ehPerfeito($numero) {
    if ($numero < 1) {
        return false;
    }
    $soma = 0;
    for ($i = 1; $i < $numero; $i++) {
        if ($numero % $i === 0) {
            $soma += $i;
        }
    }
    return $soma === $numero;
}

// Exemplo de uso
$numero = 28;
$analise = analisarNumero($numero);

echo "Número: $numero\n";
echo "Classificação: " . $analise['par_impar'] . "\n";
echo "Primalidade: " . $analise['primo'] . "\n";
echo "Perfeição: " . $analise['perfeito'] . "\n";
?>