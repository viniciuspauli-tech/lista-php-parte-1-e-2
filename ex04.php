<?php


function gerarSenha($quantidade)
{
    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
    $senha = "";

    for ($i = 0; $i < $quantidade; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $senha .= $caracteres[$indice];
    }

    return $senha;
}

$tamanho = 12;

echo "Quantidade de caracteres: $tamanho <br><br>";
echo "Senha gerada: " . gerarSenha($tamanho);

?>