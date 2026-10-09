<?php
/**
 * funcoes.php
 * Biblioteca de funções reutilizáveis para diversos sistemas.
 */

/**
 * 1. Calcula o IMC (Índice de Massa Corporal) e retorna o valor e a classificação.
 * @param float $peso Peso em kg
 * @param float $altura Altura em metros
 * @return array
 */
function calcularIMC($peso, $altura) {
    if ($altura <= 0 || $peso <= 0) {
        return "Peso e altura devem ser maiores que zero.";
    }

    $imc = $peso / ($altura * $altura);

    if ($imc < 18.5) {
        $classificacao = 'Abaixo do peso';
    } elseif ($imc < 25) {
        $classificacao = 'Peso normal';
    } elseif ($imc < 30) {
        $classificacao = 'Sobrepeso';
    } elseif ($imc < 35) {
        $classificacao = 'Obesidade Grau I';
    } elseif ($imc < 40) {
        $classificacao = 'Obesidade Grau II';
    } else {
        $classificacao = 'Obesidade Grau III';
    }

    return [
        'imc' => round($imc, 2),
        'classificacao' => $classificacao
    ];
}

/**
 * 2. Valida se uma string é um endereço de e-mail válido.
 * @param string $email
 * @return bool
 */
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * 3. Gera uma senha aleatória com o tamanho especificado.
 * @param int $tamanho
 * @param bool $incluirSimbolos
 * @return string
 */
function gerarSenhaAleatoria($tamanho = 8, $incluirSimbolos = true) {
    $letrasMinusculas = 'abcdefghijklmnopqrstuvwxyz';
    $letrasMaiusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numeros = '0123456789';
    $simbolos = '!@#$%&*_-+=';

    $caracteres = $letrasMinusculas . $letrasMaiusculas . $numeros;
    if ($incluirSimbolos) {
        $caracteres .= $simbolos;
    }

    $senha = '';
    $totalCaracteres = strlen($caracteres) - 1;

    for ($i = 0; $i < $tamanho; $i++) {
        $senha .= $caracteres[random_int(0, $totalCaracteres)];
    }

    return $senha;
}

/**
 * 4. Conta a quantidade de vogais em um texto.
 * @param string $texto
 * @return int
 */
function contarVogais($texto) {
    $textoSemAcento = removerAcentos(mb_strtolower($texto, 'UTF-8'));
    preg_match_all('/[aeiou]/', $textoSemAcento, $matches);
    return count($matches[0]);
}

/**
 * Função auxiliar: remove acentos de uma string (usada por contarVogais).
 * @param string $texto
 * @return string
 */
function removerAcentos($texto) {
    $comAcento = ['á','à','ã','â','ä','é','è','ê','ë','í','ì','î','ï','ó','ò','õ','ô','ö','ú','ù','û','ü','ç'];
    $semAcento = ['a','a','a','a','a','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','c'];
    return str_replace($comAcento, $semAcento, $texto);
}

/**
 * 5. Inverte o texto (caractere a caractere).
 * @param string $texto
 * @return string
 */
function inverterTexto($texto) {
    // Usa mb_str_split para lidar corretamente com acentos
    $caracteres = mb_str_split($texto, 1, 'UTF-8');
    return implode('', array_reverse($caracteres));
}

/**
 * 6. Calcula a idade com base na data de nascimento.
 * @param string $dataNascimento Formato: 'YYYY-MM-DD'
 * @return int|string
 */
function calcularIdade($dataNascimento) {
    try {
        $nascimento = new DateTime($dataNascimento);
        $hoje = new DateTime();

        if ($nascimento > $hoje) {
            return "Data de nascimento inválida (está no futuro).";
        }

        $diferenca = $hoje->diff($nascimento);
        return $diferenca->y;
    } catch (Exception $e) {
        return "Data inválida. Use o formato AAAA-MM-DD.";
    }
}

/**
 * 7. Converte um valor entre moedas usando uma taxa de câmbio informada.
 * @param float $valor
 * @param float $taxaCambio
 * @return float
 */
function converterMoeda($valor, $taxaCambio) {
    if ($valor < 0 || $taxaCambio <= 0) {
        return "Valor e taxa de câmbio devem ser positivos.";
    }
    return round($valor * $taxaCambio, 2);
}

/**
 * 8. Formata um número de telefone para o padrão (XX) XXXXX-XXXX ou (XX) XXXX-XXXX.
 * @param string $telefone Apenas números, ex: "11987654321"
 * @return string
 */
function formatarTelefone($telefone) {
    // Remove tudo que não for número
    $numeros = preg_replace('/\D/', '', $telefone);
    $tamanho = strlen($numeros);

    if ($tamanho === 11) {
        // Celular: (XX) XXXXX-XXXX
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $numeros);
    } elseif ($tamanho === 10) {
        // Fixo: (XX) XXXX-XXXX
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $numeros);
    }

    return "Número de telefone inválido.";
}

/**
 * 9. Gera uma saudação de acordo com o horário atual (ou um horário informado).
 * @param int|null $hora Hora de 0 a 23. Se null, usa a hora atual do servidor.
 * @return string
 */
function gerarSaudacao($hora = null) {
    if ($hora === null) {
        $hora = (int) date('H');
    }

    if ($hora >= 5 && $hora < 12) {
        return 'Bom dia!';
    } elseif ($hora >= 12 && $hora < 18) {
        return 'Boa tarde!';
    } else {
        return 'Boa noite!';
    }
}

/**
 * 10. Valida se uma senha é considerada forte.
 * Regras: mínimo 8 caracteres, ao menos 1 maiúscula, 1 minúscula, 1 número e 1 símbolo.
 * @param string $senha
 * @return array
 */
function validarSenhaForte($senha) {
    $erros = [];

    if (strlen($senha) < 8) {
        $erros[] = 'A senha deve ter no mínimo 8 caracteres.';
    }
    if (!preg_match('/[A-Z]/', $senha)) {
        $erros[] = 'A senha deve conter ao menos uma letra maiúscula.';
    }
    if (!preg_match('/[a-z]/', $senha)) {
        $erros[] = 'A senha deve conter ao menos uma letra minúscula.';
    }
    if (!preg_match('/[0-9]/', $senha)) {
        $erros[] = 'A senha deve conter ao menos um número.';
    }
    if (!preg_match('/[\W_]/', $senha)) {
        $erros[] = 'A senha deve conter ao menos um símbolo especial.';
    }

    return [
        'forte' => empty($erros),
        'erros' => $erros
    ];
}

/**
 * 11. (Bônus) Calcula o fatorial de um número.
 * @param int $numero
 * @return int|string
 */
function calcularFatorial($numero) {
    if ($numero < 0) {
        return "Não existe fatorial de número negativo.";
    }
    if ($numero === 0 || $numero === 1) {
        return 1;
    }

    $resultado = 1;
    for ($i = 2; $i <= $numero; $i++) {
        $resultado *= $i;
    }
    return $resultado;
}

/**
 * 12. (Bônus) Formata um valor numérico como moeda brasileira (R$).
 * @param float $valor
 * @return string
 */
function formatarMoedaBRL($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}