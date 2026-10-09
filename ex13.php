<?php
function criptografarMensagem($texto, $deslocamento = 3) {
    return aplicarCifraCesar($texto, $deslocamento);
}

function descriptografarMensagem($textoCriptografado, $deslocamento = 3) {
    // Descriptografar é apenas deslocar na direção oposta
    return aplicarCifraCesar($textoCriptografado, -$deslocamento);
}

// Função auxiliar que faz o deslocamento das letras
function aplicarCifraCesar($texto, $deslocamento) {
    $resultado = '';
    $tamanho = strlen($texto);

    // Normaliza o deslocamento para ficar sempre entre 0 e 25
    $deslocamento = $deslocamento % 26;
    if ($deslocamento < 0) {
        $deslocamento += 26;
    }

    for ($i = 0; $i < $tamanho; $i++) {
        $caractere = $texto[$i];
        $codigo = ord($caractere);

        if ($codigo >= 65 && $codigo <= 90) {
            // Letras maiúsculas (A-Z)
            $resultado .= chr((($codigo - 65 + $deslocamento) % 26) + 65);
        } elseif ($codigo >= 97 && $codigo <= 122) {
            // Letras minúsculas (a-z)
            $resultado .= chr((($codigo - 97 + $deslocamento) % 26) + 97);
        } else {
            // Números, espaços, pontuação e acentos permanecem inalterados
            $resultado .= $caractere;
        }
    }

    return $resultado;
}

// Exemplo de uso
$mensagemOriginal = "Ola Mundo, tudo bem?";
$deslocamento = 4;

$mensagemCriptografada = criptografarMensagem($mensagemOriginal, $deslocamento);
$mensagemDescriptografada = descriptografarMensagem($mensagemCriptografada, $deslocamento);

echo "Original: $mensagemOriginal\n";
echo "Criptografada: $mensagemCriptografada\n";
echo "Descriptografada: $mensagemDescriptografada\n";
?>