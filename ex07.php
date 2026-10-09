<?php

function calcularDesconto($valorTotal) {
    $percentualDesconto = 0;

    if ($valorTotal > 1000) {
        $percentualDesconto = 30;
    } elseif ($valorTotal > 500) {
        $percentualDesconto = 20;
    } elseif ($valorTotal > 100) {
        $percentualDesconto = 10;
    }


    $desconto = $valorTotal * ($percentualDesconto / 100);
    $valorFinal = $valorTotal - $desconto;

    return [
        'valorOriginal'     => $valorTotal,
        'descontoAplicado'  => $desconto,
        'valorFinal'        => $valorFinal,
        'percentual'        => $percentualDesconto
    ];
}