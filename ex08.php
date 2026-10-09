<?php
function ordenarNomes($nomes) {
    // Transforma a string em um vetor, separando pelos vírgulas
    $vetorNomes = explode(',', $nomes);

    // Remove espaços desnecessários no início e fim de cada nome
    $vetorNomes = array_map('trim', $vetorNomes);

    // Remove possíveis elementos vazios (ex: vírgulas extras)
    $vetorNomes = array_filter($vetorNomes, function($nome) {
        return $nome !== '';
    });

    // Ordena em ordem alfabética
    sort($vetorNomes);

    return $vetorNomes;
}

// Exemplo de uso
$listaAlunos = "Carlos, ana ,  Bruno,  Fernanda , eduardo";
$listaOrdenada = ordenarNomes($listaAlunos);

foreach ($listaOrdenada as $nome) {
    echo $nome . "\n";
}
?>