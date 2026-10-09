<?php
function analisarProdutos($produtos, $busca) {
    $maisCaro = $produtos[0];
    $maisBarato = $produtos[0];
    $soma = 0;

    foreach ($produtos as $produto) {
        if ($produto['preco'] > $maisCaro['preco']) {
            $maisCaro = $produto;
        }
        if ($produto['preco'] < $maisBarato['preco']) {
            $maisBarato = $produto;
        }
        $soma = $soma + $produto['preco'];
    }

    $media = round($soma / count($produtos), 2);

    echo "Mais caro: " . $maisCaro['nome'] . " - R$ " . $maisCaro['preco'] . "<br>";
    echo "Mais barato: " . $maisBarato['nome'] . " - R$ " . $maisBarato['preco'] . "<br>";
    echo "Media dos precos: R$ " . $media . "<br>";

    $achou = false;
    foreach ($produtos as $produto) {
        if ($produto['nome'] == $busca) {
            echo "Pesquisa: " . $produto['nome'] . " - R$ " . $produto['preco'] . "<br>";
            $achou = true;
        }
    }

    if ($achou == false) {
        echo "Produto $busca nao encontrado <br>";
    }
}

$produtos = [
    ['nome' => 'Arroz', 'preco' => 25.90],
    ['nome' => 'Feijao', 'preco' => 8.50],
    ['nome' => 'Carne', 'preco' => 45.00],
    ['nome' => 'Leite', 'preco' => 4.99]
];

analisarProdutos($produtos, 'Carne');
?>