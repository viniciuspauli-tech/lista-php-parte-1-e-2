<?php
/**
 * Conta a quantidade de caracteres do texto (incluindo espaços).
 * @param string $texto
 * @return int
 */
function contarCaracteres($texto) {
    return mb_strlen($texto, 'UTF-8');
}

/**
 * Remove espaços duplicados e espaços extras no início/fim do texto.
 * @param string $texto
 * @return string
 */
function removerEspacosDuplicados($texto) {
    $textoLimpo = preg_replace('/\s+/', ' ', $texto);
    return trim($textoLimpo);
}

/**
 * Extrai as palavras de um texto, removendo pontuação.
 * Retorna um array de palavras (sem elementos vazios).
 * @param string $texto
 * @return array
 */
function extrairPalavras($texto) {
    // Remove tudo que não for letra, número ou espaço
    $textoSemPontuacao = preg_replace('/[^\p{L}\p{N}\s]/u', '', $texto);
    $textoLimpo = removerEspacosDuplicados($textoSemPontuacao);

    if ($textoLimpo === '') {
        return [];
    }

    return explode(' ', $textoLimpo);
}

/**
 * Conta a quantidade de frases no texto, considerando . ! ? como finalizadores.
 * @param string $texto
 * @return int
 */
function contarFrases($texto) {
    $frases = preg_split('/[.!?]+/', $texto, -1, PREG_SPLIT_NO_EMPTY);
    // Remove frases que ficaram só com espaços
    $frases = array_filter($frases, function ($frase) {
        return trim($frase) !== '';
    });
    return count($frases);
}

/**
 * Encontra a palavra mais longa em um array de palavras.
 * @param array $palavras
 * @return string
 */
function encontrarPalavraMaisLonga($palavras) {
    if (empty($palavras)) {
        return '';
    }

    $maisLonga = $palavras[0];
    foreach ($palavras as $palavra) {
        if (mb_strlen($palavra, 'UTF-8') > mb_strlen($maisLonga, 'UTF-8')) {
            $maisLonga = $palavra;
        }
    }
    return $maisLonga;
}

/**
 * Encontra a palavra mais curta em um array de palavras.
 * @param array $palavras
 * @return string
 */
function encontrarPalavraMaisCurta($palavras) {
    if (empty($palavras)) {
        return '';
    }

    $maisCurta = $palavras[0];
    foreach ($palavras as $palavra) {
        if (mb_strlen($palavra, 'UTF-8') < mb_strlen($maisCurta, 'UTF-8')) {
            $maisCurta = $palavra;
        }
    }
    return $maisCurta;
}

/**
 * Conta quantas palavras distintas aparecem repetidas (mais de uma vez) no texto.
 * @param array $palavras
 * @return int
 */
function contarPalavrasRepetidas($palavras) {
    $palavrasMinusculas = array_map('mb_strtolower', $palavras);
    $frequencias = array_count_values($palavrasMinusculas);

    $repetidas = array_filter($frequencias, function ($qtd) {
        return $qtd > 1;
    });

    return count($repetidas);
}

/**
 * Retorna as N palavras mais frequentes do texto, ordenadas da mais para a menos frequente.
 * @param array $palavras
 * @param int $limite
 * @return array
 */
function obterPalavrasMaisFrequentes($palavras, $limite = 5) {
    $palavrasMinusculas = array_map('mb_strtolower', $palavras);
    $frequencias = array_count_values($palavrasMinusculas);

    arsort($frequencias); // Ordena do maior para o menor, mantendo as chaves (palavras)

    return array_slice($frequencias, 0, $limite, true);
}

/**
 * Formata o texto com a primeira letra de cada palavra em maiúscula.
 * @param string $texto
 * @return string
 */
function formatarTextoTitulo($texto) {
    $textoLimpo = removerEspacosDuplicados($texto);
    return mb_convert_case($textoLimpo, MB_CASE_TITLE, 'UTF-8');
}

/**
 * Função principal: processa o texto e organiza todas as estatísticas em um relatório.
 * @param string $texto
 * @return array
 */
function processarTexto($texto) {
    $textoSemEspacosDuplicados = removerEspacosDuplicados($texto);
    $palavras = extrairPalavras($texto);

    return [
        'total_caracteres'       => contarCaracteres($texto),
        'total_palavras'         => count($palavras),
        'total_frases'           => contarFrases($texto),
        'palavra_mais_longa'     => encontrarPalavraMaisLonga($palavras),
        'palavra_mais_curta'     => encontrarPalavraMaisCurta($palavras),
        'palavras_repetidas'     => contarPalavrasRepetidas($palavras),
        'top_5_palavras'         => obterPalavrasMaisFrequentes($palavras, 5),
        'texto_sem_espacos_duplicados' => $textoSemEspacosDuplicados,
        'texto_formatado'        => formatarTextoTitulo($texto)
    ];
}

// Exemplo de uso
$texto = "O   gato   correu   atrás do rato. O rato fugiu rápido! O gato ficou triste, mas o gato tentou de novo.";

$relatorio = processarTexto($texto);

echo "Total de caracteres: " . $relatorio['total_caracteres'] . "\n";
echo "Total de palavras: " . $relatorio['total_palavras'] . "\n";
echo "Total de frases: " . $relatorio['total_frases'] . "\n";
echo "Palavra mais longa: " . $relatorio['palavra_mais_longa'] . "\n";
echo "Palavra mais curta: " . $relatorio['palavra_mais_curta'] . "\n";
echo "Quantidade de palavras repetidas: " . $relatorio['palavras_repetidas'] . "\n";

echo "Top 5 palavras mais frequentes:\n";
foreach ($relatorio['top_5_palavras'] as $palavra => $frequencia) {
    echo "  - $palavra: $frequencia vez(es)\n";
}

echo "Texto sem espaços duplicados: " . $relatorio['texto_sem_espacos_duplicados'] . "\n";
echo "Texto formatado: " . $relatorio['texto_formatado'] . "\n";
?>