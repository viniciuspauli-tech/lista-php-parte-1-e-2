<?php
/**
 * Ordena as consultas pelo horário (ordem crescente).
 * @param array $consultas
 * @return array
 */
function ordenarPorHorario($consultas) {
    $consultasOrdenadas = $consultas;

    usort($consultasOrdenadas, function ($a, $b) {
        return strcmp($a['horario'], $b['horario']);
    });

    return $consultasOrdenadas;
}

/**
 * Pesquisa as consultas de um paciente específico (busca case-insensitive).
 * @param array $consultas
 * @param string $nomePaciente
 * @return array
 */
function pesquisarPaciente($consultas, $nomePaciente) {
    $encontradas = array_filter($consultas, function ($consulta) use ($nomePaciente) {
        return mb_strtolower($consulta['paciente']) === mb_strtolower($nomePaciente);
    });

    return array_values($encontradas); // Reindexa o array
}

/**
 * Conta a quantidade de consultas por especialidade.
 * @param array $consultas
 * @return array
 */
function contarPorEspecialidade($consultas) {
    $contagem = [];

    foreach ($consultas as $consulta) {
        $especialidade = $consulta['especialidade'];
        if (!isset($contagem[$especialidade])) {
            $contagem[$especialidade] = 0;
        }
        $contagem[$especialidade]++;
    }

    return $contagem;
}

/**
 * Conta a quantidade de pacientes diferentes (sem repetição).
 * @param array $consultas
 * @return int
 */
function contarPacientesDiferentes($consultas) {
    $pacientes = array_map(function ($consulta) {
        return mb_strtolower($consulta['paciente']);
    }, $consultas);

    $pacientesUnicos = array_unique($pacientes);

    return count($pacientesUnicos);
}

/**
 * Verifica se existem horários duplicados na agenda.
 * Retorna um array com os horários duplicados encontrados (vazio se não houver nenhum).
 * @param array $consultas
 * @return array
 */
function verificarHorariosDuplicados($consultas) {
    $horarios = array_map(function ($consulta) {
        return $consulta['horario'];
    }, $consultas);

    $contagemHorarios = array_count_values($horarios);

    $duplicados = array_filter($contagemHorarios, function ($qtd) {
        return $qtd > 1;
    });

    return array_keys($duplicados);
}

/**
 * Retorna a consulta com o horário mais cedo do dia.
 * @param array $consultasOrdenadas Já ordenadas por horário
 * @return array|null
 */
function obterPrimeiroAtendimento($consultasOrdenadas) {
    return $consultasOrdenadas[0] ?? null;
}

/**
 * Retorna a consulta com o horário mais tarde do dia.
 * @param array $consultasOrdenadas Já ordenadas por horário
 * @return array|null
 */
function obterUltimoAtendimento($consultasOrdenadas) {
    if (empty($consultasOrdenadas)) {
        return null;
    }
    return $consultasOrdenadas[count($consultasOrdenadas) - 1];
}

/**
 * Função principal: organiza a agenda e reúne todas as informações em um único array.
 * @param array $consultas
 * @param string|null $pacientePesquisado
 * @return array
 */
function organizarAgenda($consultas, $pacientePesquisado = null) {
    if (empty($consultas)) {
        return "A agenda está vazia.";
    }

    $consultasOrdenadas = ordenarPorHorario($consultas);

    $resultado = [
        'total_consultas'        => count($consultas),
        'pacientes_diferentes'   => contarPacientesDiferentes($consultas),
        'consultas_por_especialidade' => contarPorEspecialidade($consultas),
        'primeiro_atendimento'   => obterPrimeiroAtendimento($consultasOrdenadas),
        'ultimo_atendimento'     => obterUltimoAtendimento($consultasOrdenadas),
        'agenda_ordenada'        => $consultasOrdenadas,
        'horarios_duplicados'    => verificarHorariosDuplicados($consultas)
    ];

    if ($pacientePesquisado !== null) {
        $resultado['pesquisa_paciente'] = pesquisarPaciente($consultas, $pacientePesquisado);
    }

    return $resultado;
}

// Exemplo de uso
$consultas = [
    ['paciente' => 'Maria Silva',   'especialidade' => 'Cardiologia', 'data' => '2026-09-24', 'horario' => '09:00'],
    ['paciente' => 'João Souza',    'especialidade' => 'Dermatologia', 'data' => '2026-09-24', 'horario' => '08:30'],
    ['paciente' => 'Ana Paula',     'especialidade' => 'Cardiologia', 'data' => '2026-09-24', 'horario' => '10:15'],
    ['paciente' => 'Carlos Lima',   'especialidade' => 'Ortopedia',   'data' => '2026-09-24', 'horario' => '09:00'],
    ['paciente' => 'Maria Silva',   'especialidade' => 'Dermatologia', 'data' => '2026-09-24', 'horario' => '11:00'],
];

$agenda = organizarAgenda($consultas, 'Maria Silva');

echo "Total de consultas: " . $agenda['total_consultas'] . "\n";
echo "Pacientes diferentes: " . $agenda['pacientes_diferentes'] . "\n";

echo "Consultas por especialidade:\n";
foreach ($agenda['consultas_por_especialidade'] as $especialidade => $qtd) {
    echo "  - $especialidade: $qtd\n";
}

echo "Primeiro atendimento: " . $agenda['primeiro_atendimento']['horario'] . " - " . $agenda['primeiro_atendimento']['paciente'] . "\n";
echo "Último atendimento: " . $agenda['ultimo_atendimento']['horario'] . " - " . $agenda['ultimo_atendimento']['paciente'] . "\n";

echo "Agenda ordenada por horário:\n";
foreach ($agenda['agenda_ordenada'] as $consulta) {
    echo "  {$consulta['horario']} - {$consulta['paciente']} ({$consulta['especialidade']})\n";
}

echo "Horários duplicados: " . (empty($agenda['horarios_duplicados']) ? 'Nenhum' : implode(', ', $agenda['horarios_duplicados'])) . "\n";

echo "Consultas de 'Maria Silva':\n";
foreach ($agenda['pesquisa_paciente'] as $consulta) {
    echo "  {$consulta['horario']} - {$consulta['especialidade']}\n";
}
?>