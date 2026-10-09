<?php
function formatarTexto($texto) {
    return [
        'maiusculas'      => mb_strtoupper($texto, 'UTF-8'),
        'minusculas'      => mb_strtolower($texto, 'UTF-8'),
        'primeira_maiuscula' => mb_convert_case($texto, MB_CASE_TITLE, 'UTF-8'),
        'total_caracteres' => mb_strlen($texto, 'UTF-8')
    ];
}

// Exemplo de uso
$texto = "relatório de vendas mensais";
$resultado = formatarTexto($texto);

echo "Maiúsculas: " . $resultado['maiusculas'] . "\n";
echo "Minúsculas: " . $resultado['minusculas'] . "\n";
echo "Título: " . $resultado['primeira_maiuscula'] . "\n";
echo "Total de caracteres: " . $resultado['total_caracteres'] . "\n";
?>