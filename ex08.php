<?php
function ordenarNomes($nomes) {
    
    $vetorNomes = explode(',', $nomes);

    
    $vetorNomes = array_map('trim', $vetorNomes);

   
    $vetorNomes = array_filter($vetorNomes, function($nome) {
        return $nome !== '';
    });

    
    sort($vetorNomes);

    return $vetorNomes;
}

$listaAlunos = "Carlos, ana ,  Bruno,  Fernanda , eduardo";
$listaOrdenada = ordenarNomes($listaAlunos);

foreach ($listaOrdenada as $nome) {
    echo $nome . "\n";
}
?>