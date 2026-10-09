<?php
function gerarSenha($tamanho) {
    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
    $senha = "";

    for ($i = 0; $i < $tamanho; $i++) {
        $posicao = rand(0, strlen($caracteres) - 1);
        $senha = $senha . $caracteres[$posicao];
    }

    return $senha;
}

$tamanho = 12;

echo "Quantidade de caracteres: $tamanho <br>";
echo "Senha gerada: " . gerarSenha($tamanho) . "<br>";
?>