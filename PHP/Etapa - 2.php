<?php
session_start(); //Inicia a sessão novamente

//Inicializando as variáveis de erro como vazias
$erro_turno = "";
$erro_atividades = "";

//Inicializando as variáveis que vão guardar os dados do formulário
$turno = "";
$atividades = [];
$curso_selecionado = "";

//Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Criando uma variável para controlar se houver erros
    $houve_erro = false;

    //Valida o campo Turno
    if (empty($_POST["turno"])) {
        $erro_turno = "*** Por favor, escolha um turno ***";
        $houve_erro = true;
    } else {
        $turno = $_POST["turno"];
    }

    //Pega o curso selecionado, sem validação
    if (isset($_POST["curso"])) {
        $curso_selecionado = $_POST["curso"];
    } else {
        //Se não for enviado, nunca vai ser verdadeiro mas apenas por via das dúvidas
        $curso_selecionado = "";
    }

    //Valida o campo Atividades Extras
    if (isset($_POST["atividades"])) {
        $atividades = $_POST["atividades"];
    } else {
        $atividades = []; //Garante que $atividades seja um array vazio se nada for selecionado
    }
    
    //Se não houver nenhum erro
    if ($houve_erro == false) {
        // Pegando os dados da sessão da Etapa 1
        $dados_anteriores = $_SESSION['cliente'];

        //Adiciona os novos dados
        $dados_anteriores['curso'] = $curso_selecionado;
        $dados_anteriores['turno'] = $turno;
        $dados_anteriores['atividades'] = $atividades;

        //Salva todos os dados na sessão novamente
        $_SESSION['cliente'] = $dados_anteriores;

        //Redireciona para a próxima etapa
        header("Location: Etapa - 3.php");
        exit(); //Garante que o script pare, é uma boa prática
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>Preferências do Curso</title>
</head>
<body bgcolor="#b9ffff" style="color: black;">
    <form method="POST" action="Etapa - 2.php">
        <h1 style="text-align: center; margin: 0; padding: 0">Escolha o Curso</h1><br>

        <fieldset style="width: 50%; margin: 0 auto"><br>
            <label for="curso">Curso:</label><br><br>
            <select id="curso" name="curso" style="padding: 5px; margin-bottom: 10px; width: 150px;">
                <option value="pedagogia" <?php echo ($curso_selecionado == "pedagogia") ? "selected" : "";?>>Pedagogia</option>
                <option value="administracao" <?php echo ($curso_selecionado == "administracao") ? "selected" : "";?>>Administração</option>
                <option value="ciencias_contabeis" <?php echo ($curso_selecionado == "ciencias_contabeis") ? "selected" : "";?>>Ciências Contábeis</option>
                <option value="enfermagem" <?php echo ($curso_selecionado == "enfermagem") ? "selected" : "";?>>Enfermagem</option>
            </select>
            <br><br>

            <label for="turno">Turno:</label><br>
            <input type="radio" id="manha" name="turno" value="manha" <?php echo ($turno == "manha") ? "checked" : "";?>>
            <label for="manha">Manhã</label><br>

            <input type="radio" id="tarde" name="turno" value="tarde" <?php echo ($turno == "tarde") ? "checked" : "";?>>
            <label for="tarde">Tarde</label><br>

            <input type="radio" id="noite" name="turno" value="noite" <?php echo ($turno == "noite") ? "checked" : "";?>>
            <label for="noite">Noite</label>
            <span class="erro" style="color: red;"><?php echo $erro_turno;?></span><br><br>

            <label>Atividades Extras:</label><br>
            <input type="checkbox" id="rua" name="atividades[]" value="rua" <?php echo (in_array("rua", $atividades)) ? "checked" : "";?>>
            <label for="rua">Como Atravessar a Rua</label><br>

            <input type="checkbox" id="aviao" name="atividades[]" value="aviao" <?php echo (in_array("aviao", $atividades)) ? "checked" : "";?>>
            <label for="aviao">Criando um Avião Caseiro</label><br>

            <input type="checkbox" id="incendio" name="atividades[]" value="fogo" <?php echo (in_array("incendio", $atividades)) ? "checked" : "";?>>
            <label for="incendio">Como Apagar um Incêndio Predial</label><br><br>
        </fieldset><br>

        <div style="display: flex; gap:20px; justify-content: center">
            <input type="submit" value="Próximo" style="cursor: pointer">
        </div>
    </form>
</body>
</html>