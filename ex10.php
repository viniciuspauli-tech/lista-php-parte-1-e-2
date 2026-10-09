<?php
function calcularMedia($notas) {
    if (empty($notas)) {
        return "O vetor de notas está vazio.";
    }

    $maior = max($notas);
    $menor = min($notas);
    $media = array_sum($notas) / count($notas);

    // Definindo a situação final com base na média
    if ($media >= 7) {
        $situacao = 'Aprovado';
    } elseif ($media >= 5) {
        $situacao = 'Recuperação';
    } else {
        $situacao = 'Reprovado';
    }

    return [
        'maior_nota' => $maior,
        'menor_nota' => $menor,
        'media'      => round($media, 2),
        'situacao'   => $situacao
    ];
}

// Exemplo de uso
$notasAluno = [7.5, 6.0, 8.5, 5.0];
$resultado = calcularMedia($notasAluno);

echo "Maior nota: " . $resultado['maior_nota'] . "\n";
echo "Menor nota: " . $resultado['menor_nota'] . "\n";
echo "Média: " . $resultado['media'] . "\n";
echo "Situação: " . $resultado['situacao'] . "\n";
?>