<?php
/**
 * Conta a quantidade de letras maiúsculas em uma senha.
 * @param string $senha
 * @return int
 */
function contarMaiusculas($senha) {
    preg_match_all('/[A-Z]/', $senha, $matches);
    return count($matches[0]);
}

/**
 * Conta a quantidade de letras minúsculas em uma senha.
 * @param string $senha
 * @return int
 */
function contarMinusculas($senha) {
    preg_match_all('/[a-z]/', $senha, $matches);
    return count($matches[0]);
}

/**
 * Conta a quantidade de números em uma senha.
 * @param string $senha
 * @return int
 */
function contarNumeros($senha) {
    preg_match_all('/[0-9]/', $senha, $matches);
    return count($matches[0]);
}

/**
 * Conta a quantidade de caracteres especiais em uma senha.
 * (Tudo que não for letra ou número)
 * @param string $senha
 * @return int
 */
function contarCaracteresEspeciais($senha) {
    preg_match_all('/[^a-zA-Z0-9]/', $senha, $matches);
    return count($matches[0]);
}

/**
 * Classifica o nível de segurança da senha com base nos critérios:
 * tamanho mínimo, presença de maiúsculas, minúsculas, números e símbolos.
 * @param int $tamanho
 * @param int $maiusculas
 * @param int $minusculas
 * @param int $numeros
 * @param int $especiais
 * @return string
 */
function classificarSeguranca($tamanho, $maiusculas, $minusculas, $numeros, $especiais) {
    $criteriosAtendidos = 0;

    if ($tamanho >= 8) {
        $criteriosAtendidos++;
    }
    if ($maiusculas > 0) {
        $criteriosAtendidos++;
    }
    if ($minusculas > 0) {
        $criteriosAtendidos++;
    }
    if ($numeros > 0) {
        $criteriosAtendidos++;
    }
    if ($especiais > 0) {
        $criteriosAtendidos++;
    }

    // Senha muito curta é sempre considerada Fraca, independente de outros critérios
    if ($tamanho < 6) {
        return 'Fraca';
    }

    switch ($criteriosAtendidos) {
        case 5:
            return 'Muito Forte';
        case 4:
            return 'Forte';
        case 3:
            return 'Média';
        default:
            return 'Fraca';
    }
}

/**
 * Função principal: organiza o relatório completo da análise da senha.
 * @param string $senha
 * @return array
 */
function analisarSenha($senha) {
    $tamanho = strlen($senha);
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarCaracteresEspeciais($senha);

    $nivelSeguranca = classificarSeguranca($tamanho, $maiusculas, $minusculas, $numeros, $especiais);

    return [
        'tamanho'            => $tamanho,
        'maiusculas'         => $maiusculas,
        'minusculas'         => $minusculas,
        'numeros'            => $numeros,
        'caracteres_especiais' => $especiais,
        'nivel_seguranca'    => $nivelSeguranca
    ];
}

// Exemplo de uso
$senhasTeste = [
    '123456',
    'senha123',
    'Senha123',
    'S3nh@Forte!'
];

foreach ($senhasTeste as $senha) {
    $relatorio = analisarSenha($senha);

    echo "Senha: \"$senha\"\n";
    echo "  Tamanho: " . $relatorio['tamanho'] . "\n";
    echo "  Maiúsculas: " . $relatorio['maiusculas'] . "\n";
    echo "  Minúsculas: " . $relatorio['minusculas'] . "\n";
    echo "  Números: " . $relatorio['numeros'] . "\n";
    echo "  Caracteres especiais: " . $relatorio['caracteres_especiais'] . "\n";
    echo "  Nível de segurança: " . $relatorio['nivel_seguranca'] . "\n";
    echo "----------------------------------\n";
}
?>