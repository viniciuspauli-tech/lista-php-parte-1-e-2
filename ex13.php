<?php
function criptografar($texto, $deslocamento) {
    $resultado = "";

    for ($i = 0; $i < strlen($texto); $i++) {
        $letra = $texto[$i];

        if ($letra >= 'a' && $letra <= 'z') {
            $numero = ord($letra) - ord('a');
            $numero = ($numero + $deslocamento) % 26;
            $letra = chr($numero + ord('a'));
        } elseif ($letra >= 'A' && $letra <= 'Z') {
            $numero = ord($letra) - ord('A');
            $numero = ($numero + $deslocamento) % 26;
            $letra = chr($numero + ord('A'));
        }

        $resultado = $resultado . $letra;
    }

    return $resultado;
}

function descriptografar($texto, $deslocamento) {
    return criptografar($texto, 26 - $deslocamento);
}

$mensagem = "Ola Mundo, tudo bem?";
$deslocamento = 4;

$criptografada = criptografar($mensagem, $deslocamento);
$descriptografada = descriptografar($criptografada, $deslocamento);

echo "Original: $mensagem <br>";
echo "Criptografada: $criptografada <br>";
echo "Descriptografada: $descriptografada <br>";
?>