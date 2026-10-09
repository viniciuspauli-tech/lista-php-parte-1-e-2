<?php
function analisarTexto($texto) {
   
    $textoLimpo = $texto;
    while (strpos($textoLimpo, "  ") !== false) {
        $textoLimpo = str_replace("  ", " ", $textoLimpo);
    }
    $textoLimpo = trim($textoLimpo);

    
    $frases = 0;
    for ($i = 0; $i < strlen($textoLimpo); $i++) {
        $c = $textoLimpo[$i];
        if ($c == "." || $c == "!" || $c == "?") {
            $frases++;
        }
    }

    
    $semPontuacao = str_replace([".", ",", "!", "?"], "", strtolower($textoLimpo));
    $palavras = explode(" ", $semPontuacao);

   
    $maisLonga = $palavras[0];
    $maisCurta = $palavras[0];
    foreach ($palavras as $palavra) {
        if (strlen($palavra) > strlen($maisLonga)) {
            $maisLonga = $palavra;
        }
        if (strlen($palavra) < strlen($maisCurta)) {
            $maisCurta = $palavra;
        }
    }

    
    $contagem = [];
    foreach ($palavras as $palavra) {
        if (isset($contagem[$palavra])) {
            $contagem[$palavra]++;
        } else {
            $contagem[$palavra] = 1;
        }
    }

    
    $repetidas = 0;
    foreach ($contagem as $palavra => $vezes) {
        if ($vezes > 1) {
            $repetidas++;
        }
    }

    arsort($contagem);

    echo "Caracteres: " . strlen($texto) . "<br>";
    echo "Palavras: " . count($palavras) . "<br>";
    echo "Frases: $frases <br>";
    echo "Palavra mais longa: $maisLonga <br>";
    echo "Palavra mais curta: $maisCurta <br>";
    echo "Palavras repetidas: $repetidas <br>";

    echo "Top 5 palavras:<br>";
    $posicao = 0;
    foreach ($contagem as $palavra => $vezes) {
        if ($posicao < 5) {
            echo "- $palavra: $vezes <br>";
        }
        $posicao++;
    }

    echo "Sem espacos duplicados: $textoLimpo <br>";
    echo "Formatado: " . ucwords(strtolower($textoLimpo)) . "<br>";
}

$texto = "O   gato   correu   atras do rato. O rato fugiu rapido! O gato ficou triste, mas o gato tentou de novo.";
analisarTexto($texto);
?>