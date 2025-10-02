<?php
session_start(); // Inicia a sessão para recuperar os dados

// Verifica se existem dados na sessão. Se não houver, redireciona para a Etapa 1 hehehehe
if (!isset($_SESSION['cliente'])) {
    header("Location: Etapa - 1.php");
    exit();
}

//Recupera todos os dados salvos na sessão (ao longo das etapas)
$dados_cliente = $_SESSION['cliente'];

//Dados Pessoais
$nome = isset($dados_cliente['nome']) ? htmlspecialchars($dados_cliente['nome']) : 'N/A';
$email = isset($dados_cliente['email']) ? htmlspecialchars($dados_cliente['email']) : 'N/A';
$idade = isset($dados_cliente['idade']) ? htmlspecialchars($dados_cliente['idade']) : 'N/A';
$sexo = isset($dados_cliente['sexo']) ? htmlspecialchars($dados_cliente['sexo']) : 'N/A';
$cpf = isset($dados_cliente['cpf']) ? htmlspecialchars($dados_cliente['cpf']) : 'N/A';
$telefone = isset($dados_cliente['telefone']) ? htmlspecialchars($dados_cliente['telefone']) : 'N/A';
$cidade = isset($dados_cliente['cidade']) ? htmlspecialchars($dados_cliente['cidade']) : 'N/A';
$estado = isset($dados_cliente['estado']) ? htmlspecialchars($dados_cliente['estado']) : 'N/A';
$endereco = isset($dados_cliente['endereco']) ? htmlspecialchars($dados_cliente['endereco']) : 'N/A';
$cep = isset($dados_cliente['cep']) ? htmlspecialchars($dados_cliente['cep']) : 'N/A';

//Curso Escolhido
$curso_selecionado = isset($dados_cliente['curso']) ? htmlspecialchars($dados_cliente['curso']) : 'N/A';
$turno = isset($dados_cliente['turno']) ? htmlspecialchars($dados_cliente['turno']) : 'N/A';
$atividades = isset($dados_cliente['atividades']) ? $dados_cliente['atividades'] : []; // Array vazio se não houver

//Pagamento e Modalidade
$pagamento_selecionado = isset($dados_cliente['pagamento']) ? htmlspecialchars($dados_cliente['pagamento']) : 'N/A';
$modalidade_selecionada = isset($dados_cliente['modalidade']) ? htmlspecialchars($dados_cliente['modalidade']) : 'N/A';

// --- Função para formatar atividades (se necessário) ---
// Mantivemos a função, pois ela pode ser útil se os valores dos checkboxes forem curtos
// e você quiser exibir nomes mais descritivos na finalização.
function formatar_atividades($atividades) {
    if (empty($atividades)) {
        return "Nenhuma"; //Aqui ele apresenta como "Nenhuma" caso o campo esteja vazio
    }
    // Mapeia os valores internos para nomes mais amigáveis.
    // Se os nomes no HTML já são amigáveis, pode usar diretamente.
    $nomes_amigaveis = [
        'rua' => 'Como Atravessar a Rua',
        'aviao' => 'Criando um Avião Caseiro',
        'fogo' => 'Como Apagar um Incêndio Predial',
    ];

    $atividades_formatadas = [];
    foreach ($atividades as $atividade) {
        if (isset($nomes_amigaveis[$atividade])) {
            $atividades_formatadas[] = $nomes_amigaveis[$atividade];
        }
    }
    return implode(', ', $atividades_formatadas); //a função implode pega um array de strings e une elas numa só (caso sejam várias esc.)
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>Confirmação da Inscrição</title>
</head>
<body bgcolor="#b9ffff" style="color: black;">
    <h1 style="text-align: center; margin: 0; padding: 0">Confirmação da Inscrição</h1><br>

    <fieldset style="width: 70%; margin: 0 auto">
        <legend>Dados Pessoais</legend>
        <p><strong>Nome:</strong> <?php echo $nome; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Idade:</strong> <?php echo $idade; ?></p>
        <p><strong>Sexo:</strong> <?php echo $sexo; ?></p>
        <p><strong>CPF:</strong> <?php echo $cpf; ?></p>
        <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
        <p><strong>Cidade:</strong> <?php echo $cidade; ?></p>
        <p><strong>Estado:</strong> <?php echo $estado; ?></p>
        <p><strong>Endereço:</strong> <?php echo $endereco; ?></p>
        <p><strong>CEP:</strong> <?php echo $cep; ?></p>
    </fieldset><br>

    <fieldset style="width: 70%; margin: 0 auto">
        <legend>Curso Escolhido</legend>
        <p><strong>Curso:</strong> <?php echo $curso_selecionado; ?></p>
        <p><strong>Turno:</strong> <?php echo $turno; ?></p>
        <p><strong>Atividades Extras:</strong> <?php echo formatar_atividades($atividades); ?></p>
    </fieldset><br>

    <fieldset style="width: 70%; margin: 0 auto">
        <legend>Pagamento e Modalidade</legend>
        <p><strong>Forma de Pagamento:</strong> <?php echo $pagamento_selecionado; ?></p>
        <p><strong>Modalidade:</strong> <?php echo $modalidade_selecionada; ?></p>
    </fieldset><br>

    <div style="display: flex; gap:20px; justify-content: center">
        <input type="button" value="Nova Inscrição" onclick="window.location.href='Etapa - 1.php';" style="cursor: pointer">
    </div>
</body>
</html>