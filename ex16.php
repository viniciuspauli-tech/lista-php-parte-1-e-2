<?php
function analisarSenha($senha) {
    $tamanho = strlen($senha);
    $maiusculas = 0;
    $minusculas = 0;
    $numeros = 0;
    $especiais = 0;

    for ($i = 0; $i < $tamanho; $i++) {
        $c = $senha[$i];

        if (ctype_upper($c)) {
            $maiusculas++;
        } elseif (ctype_lower($c)) {
            $minusculas++;
        } elseif (ctype_digit($c)) {
            $numeros++;
        } else {
            $especiais++;
        }
    }

  
    $criterios = 0;
    if ($tamanho >= 8) {
        $criterios++;
    }
    if ($maiusculas > 0) {
        $criterios++;
    }
    if ($minusculas > 0) {
        $criterios++;
    }
    if ($numeros > 0) {
        $criterios++;
    }
    if ($especiais > 0) {
        $criterios++;
    }

    if ($tamanho < 6) {
        $nivel = "Fraca";
    } elseif ($criterios == 5) {
        $nivel = "Muito forte";
    } elseif ($criterios == 4) {
        $nivel = "Forte";
    } elseif ($criterios == 3) {
        $nivel = "Media";
    } else {
        $nivel = "Fraca";
    }

    echo "Senha: $senha <br>";
    echo "Tamanho: $tamanho <br>";
    echo "Maiusculas: $maiusculas <br>";
    echo "Minusculas: $minusculas <br>";
    echo "Numeros: $numeros <br>";
    echo "Especiais: $especiais <br>";
    echo "Nivel: $nivel <br>";
    echo "---------------<br>";
}

$senhas = ["123456", "senha123", "Senha123", "S3nh@Forte!"];

foreach ($senhas as $senha) {
    analisarSenha($senha);
}
?>