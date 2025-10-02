<?php
session_start(); //Inicia a nova sessão

//Se os dados do cliente não estiverem na sessão, redireciona para a Etapa 1 :D
if (!isset($_SESSION['cliente'])) {
    header("Location: Etapa - 1.php");
    exit();
}

//Inicializando as variáveis de erro como vazias
$erro_pagamento = "";
$erro_modalidade = "";

//Inicializando as variáveis que vão guardar os dados do formulário
$pagamento = "";
$modalidade = "";

//Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Criando uma variável para controlar se houver erros
    $houve_erro = false;

    //Valida o campo Pagamento
    if (empty($_POST["pagamento"])) {
        $erro_pagamento = "*** Por favor, selecione uma forma de pagamento ***";
        $houve_erro = true;
    } else {
        $pagamento = $_POST["pagamento"];
    }

    //Valida o campo Modalidade
    if (empty($_POST["modalidade"])) {
        $erro_modalidade = "*** Por favor, selecione uma modalidade ***";
        $houve_erro = true;
    } else {
        $modalidade = $_POST["modalidade"];
    }

    //Se não houver nenhum erro, salva os dados na sessão
    if ($houve_erro == false) {
        // Pega os dados das sessões anteriores
        $dados_anteriores = $_SESSION['cliente'];

        //Adiciona os novos dados desta etapa
        $dados_anteriores['pagamento'] = $pagamento;
        $dados_anteriores['modalidade'] = $modalidade;

        //Salva todos os dados na sessão novamente
        $_SESSION['cliente'] = $dados_anteriores;

        //Redireciona para a próxima etapa (Finalização)
        header("Location: Finalização.php");
        exit();
    }
} else {
    //Se não for um POST, mas os dados já estiverem na sessão, recupera-os para manter a seleção
    if (isset($_SESSION['cliente']['pagamento'])) {
        $pagamento = $_SESSION['cliente']['pagamento'];
    }
    if (isset($_SESSION['cliente']['modalidade'])) {
        $modalidade = $_SESSION['cliente']['modalidade'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>Pagamento e Modalidade</title>
</head>
<body bgcolor="#b9ffff" style="color: black;">
    <form method="POST" action="Etapa - 3.php">
        <h1 style="text-align: center; margin: 0; padding: 0">Pagamento e Modalidade</h1><br>

        <fieldset style="width: 50%; margin: 0 auto"><br>
            <label for="pagamento">Forma de Pagamento:</label><br>
            <select id="pagamento" name="pagamento" style="padding: 5px; margin-bottom: 10px; width: 180px;">
                <option value="Boleto Bancário" <?php echo ($pagamento == "Boleto Bancário") ? "selected" : "";?>>Boleto Bancário</option>
                <option value="Cartão de Crédito" <?php echo ($pagamento == "Cartão de Crédito") ? "selected" : "";?>>Cartão de Crédito</option>
                <option value="Pix" <?php echo ($pagamento == "Pix") ? "selected" : "";?>>Pix</option>
            </select>
            <span class="erro" style="color: red;"><?php echo $erro_pagamento;?></span><br><br>

            <label>Modalidade:</label><br>
            <input type="radio" id="presencial" name="modalidade" value="Presencial" <?php echo ($modalidade == "Presencial") ? "checked" : "";?>>
            <label for="presencial">Presencial</label><br>

            <input type="radio" id="online" name="modalidade" value="Online" <?php echo ($modalidade == "Online") ? "checked" : "";?>>
            <label for="online">Online</label><br>

            <input type="radio" id="hibrido" name="modalidade" value="Híbrido" <?php echo ($modalidade == "Híbrido") ? "checked" : "";?>>
            <label for="hibrido">Híbrido</label>
            <span class="erro" style="color: red;"><?php echo $erro_modalidade;?></span><br><br>
        </fieldset><br>

        <div style="display: flex; gap:20px; justify-content: center">
            <input type="submit" value="Próximo" style="cursor: pointer">
        </div>
    </form>
</body>
</html>