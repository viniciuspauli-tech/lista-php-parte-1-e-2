<?php

function calcularIMC($peso, $altura) {
    $imc = $peso / ($altura * $altura);

    if ($imc < 18.5) {
        $classificacao = "Abaixo do peso";
    } elseif ($imc < 25) {
        $classificacao = "Peso normal";
    } elseif ($imc < 30) {
        $classificacao = "Sobrepeso";
    } else {
        $classificacao = "Obesidade";
    }

    return "IMC: " . round($imc, 2) . " - " . $classificacao;
}


function validarEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}


function gerarSenha($tamanho) {
    $letras = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $senha = "";

    for ($i = 0; $i < $tamanho; $i++) {
        $posicao = rand(0, strlen($letras) - 1);
        $senha = $senha . $letras[$posicao];
    }

    return $senha;
}


function contarVogais($texto) {
    $vogais = "aeiouAEIOU";
    $total = 0;

    for ($i = 0; $i < strlen($texto); $i++) {
        if (strpos($vogais, $texto[$i]) !== false) {
            $total++;
        }
    }

    return $total;
}


function inverterTexto($texto) {
    return strrev($texto);
}


function calcularIdade($dataNascimento) {
    $partes = explode("-", $dataNascimento);
    $ano = $partes[0];
    $mes = $partes[1];
    $dia = $partes[2];

    $idade = date("Y") - $ano;

    if (date("m") < $mes || (date("m") == $mes && date("d") < $dia)) {
        $idade = $idade - 1;
    }

    return $idade;
}


function converterMoeda($valor, $taxa) {
    return round($valor * $taxa, 2);
}


function formatarTelefone($telefone) {
    $ddd = substr($telefone, 0, 2);
    $parte1 = substr($telefone, 2, 5);
    $parte2 = substr($telefone, 7, 4);

    return "($ddd) $parte1-$parte2";
}


function saudacao($hora) {
    if ($hora < 12) {
        return "Bom dia!";
    } elseif ($hora < 18) {
        return "Boa tarde!";
    } else {
        return "Boa noite!";
    }
}


function senhaForte($senha) {
    $maiuscula = false;
    $minuscula = false;
    $numero = false;
    $simbolo = false;

    for ($i = 0; $i < strlen($senha); $i++) {
        $c = $senha[$i];

        if (ctype_upper($c)) {
            $maiuscula = true;
        } elseif (ctype_lower($c)) {
            $minuscula = true;
        } elseif (ctype_digit($c)) {
            $numero = true;
        } else {
            $simbolo = true;
        }
    }

    if (strlen($senha) >= 8 && $maiuscula && $minuscula && $numero && $simbolo) {
        return true;
    }
    return false;
}

function fatorial($n) {
    $resultado = 1;

    for ($i = 2; $i <= $n; $i++) {
        $resultado = $resultado * $i;
    }

    return $resultado;
}


function formatarReais($valor) {
    return "R$ " . number_format($valor, 2, ",", ".");
}


echo calcularIMC(70, 1.75) . "<br>";
echo "Email valido? " . (validarEmail("teste@email.com") ? "sim" : "nao") . "<br>";
echo "Senha gerada: " . gerarSenha(8) . "<br>";
echo "Vogais: " . contarVogais("Programacao") . "<br>";
echo "Invertido: " . inverterTexto("PHP") . "<br>";
echo "Idade: " . calcularIdade("2000-05-10") . "<br>";
echo "Conversao: " . converterMoeda(100, 5.2) . "<br>";
echo "Telefone: " . formatarTelefone("47987654321") . "<br>";
echo "Saudacao: " . saudacao(14) . "<br>";
echo "Senha forte? " . (senhaForte("Abc@1234") ? "sim" : "nao") . "<br>";
echo "Fatorial de 5: " . fatorial(5) . "<br>";
echo "Valor: " . formatarReais(1234.5) . "<br>";
?>