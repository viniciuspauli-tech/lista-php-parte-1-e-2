<?php
function organizarAgenda($consultas, $pacienteBusca) {
    $total = count($consultas);

  
    for ($i = 0; $i < $total; $i++) {
        for ($j = $i + 1; $j < $total; $j++) {
            if ($consultas[$j]['horario'] < $consultas[$i]['horario']) {
                $temp = $consultas[$i];
                $consultas[$i] = $consultas[$j];
                $consultas[$j] = $temp;
            }
        }
    }

    echo "Total de consultas: $total <br>";


    $pacientes = [];
    $especialidades = [];
    foreach ($consultas as $consulta) {
        $pacientes[$consulta['paciente']] = 1;

        $esp = $consulta['especialidade'];
        if (isset($especialidades[$esp])) {
            $especialidades[$esp]++;
        } else {
            $especialidades[$esp] = 1;
        }
    }
    echo "Pacientes diferentes: " . count($pacientes) . "<br>";

    echo "Consultas por especialidade:<br>";
    foreach ($especialidades as $esp => $qtd) {
        echo "- $esp: $qtd <br>";
    }

   
    $primeiro = $consultas[0];
    $ultimo = $consultas[$total - 1];
    echo "Primeiro atendimento: " . $primeiro['horario'] . " - " . $primeiro['paciente'] . "<br>";
    echo "Ultimo atendimento: " . $ultimo['horario'] . " - " . $ultimo['paciente'] . "<br>";

   
    echo "Agenda ordenada:<br>";
    foreach ($consultas as $consulta) {
        echo $consulta['horario'] . " - " . $consulta['paciente'] . " (" . $consulta['especialidade'] . ")<br>";
    }

    
    echo "Horarios duplicados:<br>";
    $achouDuplicado = false;
    for ($i = 0; $i < $total - 1; $i++) {
        if ($consultas[$i]['horario'] == $consultas[$i + 1]['horario']) {
            echo "- " . $consultas[$i]['horario'] . "<br>";
            $achouDuplicado = true;
        }
    }
    if ($achouDuplicado == false) {
        echo "Nenhum <br>";
    }

    
    echo "Consultas de $pacienteBusca:<br>";
    foreach ($consultas as $consulta) {
        if ($consulta['paciente'] == $pacienteBusca) {
            echo $consulta['horario'] . " - " . $consulta['especialidade'] . "<br>";
        }
    }
}

$consultas = [
    ['paciente' => 'Maria Silva', 'especialidade' => 'Cardiologia', 'data' => '2026-09-24', 'horario' => '09:00'],
    ['paciente' => 'Joao Souza', 'especialidade' => 'Dermatologia', 'data' => '2026-09-24', 'horario' => '08:30'],
    ['paciente' => 'Ana Paula', 'especialidade' => 'Cardiologia', 'data' => '2026-09-24', 'horario' => '10:15'],
    ['paciente' => 'Carlos Lima', 'especialidade' => 'Ortopedia', 'data' => '2026-09-24', 'horario' => '09:00'],
    ['paciente' => 'Maria Silva', 'especialidade' => 'Dermatologia', 'data' => '2026-09-24', 'horario' => '11:00']
];

organizarAgenda($consultas, 'Maria Silva');
?>