<?php


function analisarTexto($texto)
{
    $palavras = str_word_count($texto);
    $caracteres = mb_strlen($texto);

    $vogais = preg_match_all('/[aeiouáàãâéêíóôõúü]/iu', $texto);

    $consoantes = preg_match_all('/[bcdfghjklmnpqrstvwxyzç]/iu', $texto);

    return [
        "palavras" => $palavras,
        "caracteres" => $caracteres,
        "vogais" => $vogais,
        "consoantes" => $consoantes
    ];
}

$texto = "Programação em PHP é muito interessante!";

$resultado = analisarTexto($texto);

echo "Texto: $texto <br><br>";
echo "Quantidade de palavras: " . $resultado["palavras"] . "<br>";
echo "Quantidade de caracteres: " . $resultado["caracteres"] . "<br>";
echo "Quantidade de vogais: " . $resultado["vogais"] . "<br>";
echo "Quantidade de consoantes: " . $resultado["consoantes"] . "<br>";

?>