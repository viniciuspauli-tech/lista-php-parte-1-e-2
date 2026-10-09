<?php
function analisarTexto($texto) {
    $vogais = 0;
    $consoantes = 0;

    for ($i = 0; $i < strlen($texto); $i++) {
        $letra = strtolower($texto[$i]);

        if (strpos("aeiou", $letra) !== false) {
            $vogais++;
        } elseif (ctype_alpha($letra)) {
            $consoantes++;
        }
    }

    echo "Texto: $texto <br>";
    echo "Palavras: " . str_word_count($texto) . "<br>";
    echo "Caracteres: " . strlen($texto) . "<br>";
    echo "Vogais: $vogais <br>";
    echo "Consoantes: $consoantes <br>";
}

$texto = "Programacao em PHP e muito interessante!";
analisarTexto($texto);
?>