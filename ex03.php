<?php
function mascararCpf($cpf) {
    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);

    $total = strlen($cpf);
    $estrelas = str_repeat("*", $total - 4);
    $final = substr($cpf, -4);

    return $estrelas . $final;
}

$cpf = "123.456.789-00";

echo "CPF original: $cpf <br>";
echo "CPF mascarado: " . mascararCpf($cpf) . "<br>";
?>