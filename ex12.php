<?php
function analisarProdutos($produtos, $produtoPesquisado = null) {
    if (empty($produtos)) {
        return "O catálogo está vazio.";
    }

    // Ordena por preço para achar facilmente o mais caro e o mais barato
    $maisCaro = $produtos[0];
    $maisBarato = $produtos[0];
    $somaPrecos = 0;

    foreach ($produtos as $produto) {
        if ($produto['preco'] > $maisCaro['preco']) {
            $maisCaro = $produto;
        }
        if ($produto['preco'] < $maisBarato['preco']) {
            $maisBarato = $produto;
        }
        $somaPrecos += $produto['preco'];
    }

    $media = $somaPrecos / count($produtos);

    $resultado = [
        'mais_caro'   => $maisCaro,
        'mais_barato' => $maisBarato,
        'media_precos' => round($media, 2)
    ];

    // Pesquisa de um produto específico (busca case-insensitive)
    if ($produtoPesquisado !== null) {
        $encontrado = null;
        foreach ($produtos as $produto) {
            if (mb_strtolower($produto['nome']) === mb_strtolower($produtoPesquisado)) {
                $encontrado = $produto;
                break;
            }
        }
        $resultado['pesquisa'] = $encontrado !== null
            ? $encontrado
            : "Produto \"$produtoPesquisado\" não encontrado.";
    }

    return $resultado;
}

// Exemplo de uso
$produtos = [
    ['nome' => 'Arroz', 'preco' => 25.90],
    ['nome' => 'Feijão', 'preco' => 8.50],
    ['nome' => 'Carne', 'preco' => 45.00],
    ['nome' => 'Leite', 'preco' => 4.99],
];

$resultado = analisarProdutos($produtos, 'Carne');

echo "Mais caro: " . $resultado['mais_caro']['nome'] . " - R$ " . $resultado['mais_caro']['preco'] . "\n";
echo "Mais barato: " . $resultado['mais_barato']['nome'] . " - R$ " . $resultado['mais_barato']['preco'] . "\n";
echo "Média de preços: R$ " . $resultado['media_precos'] . "\n";

if (is_array($resultado['pesquisa'])) {
    echo "Pesquisa: " . $resultado['pesquisa']['nome'] . " - R$ " . $resultado['pesquisa']['preco'] . "\n";
} else {
    echo $resultado['pesquisa'] . "\n";
}
?>