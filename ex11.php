<?php
function formatarTexto($texto) {
    echo "Maiusculas: " . strtoupper($texto) . "<br>";
    echo "Minusculas: " . strtolower($texto) . "<br>";
    echo "Primeira maiuscula: " . ucwords($texto) . "<br>";
    echo "Total de caracteres: " . strlen($texto) . "<br>";
}

$texto = "relatorio de vendas mensais";
formatarTexto($texto);
?>