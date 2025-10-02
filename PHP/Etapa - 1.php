<?php
session_start(); //Inicia a sessão antes de tudo, é primordial pq começamos atribuindo as variáveis

//Inicializando as variáveis de erro como vazias
$erro_cpf = "";
$erro_nome = "";
$erro_email = "";
$erro_idade = "";
$erro_sexo = "";
$erro_telefone = "";
$erro_cidade = "";
$erro_estado = "";
$erro_endereco = "";
$erro_cep = "";

//Criando as variáveis para os dados do formulário
$cpf = "";
$nome = "";
$email = "";
$idade = "";
$sexo = "";
$telefone = "";
$cidade = "";
$estado = "";
$endereco = "";
$cep = "";

//Verifica se o formulário foi enviado corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //CPF
    if (empty($_POST["cpf"])) {
        $erro_cpf = "Por favor, preencha o CPF";
    } else {
        $cpf = $_POST["cpf"];
    }

    //Nome
    if (empty($_POST["nome"])) {
        $erro_nome = "Preencha o nome";
    } else {
        $nome = $_POST["nome"];
    }

    //Email
    if (empty($_POST["email"])) {
        $erro_email = "Por favor, preencha o email";
    } else {
        $email = $_POST["email"];
    }

    //Idade
    if (empty($_POST["idade"])) {
        $erro_idade = "Por favor, preencha a idade";
    } else {
        $idade = $_POST["idade"];
    }

    //Sexo
    if (empty($_POST["sexo"])) {
        $erro_sexo = "Por favor, escolha o sexo";
    } else {
        $sexo = $_POST["sexo"];
    }

    //Telefone
    if (empty($_POST["telefone"])) {
        $erro_telefone = "Por favor, preencha o telefone";
    } else {
        $telefone = $_POST["telefone"];
    }

    //Cidade
    if (empty($_POST["cidade"])) {
        $erro_cidade = "Informe a cidade";
    } else {
        $cidade = $_POST["cidade"];
    }

    //Estado
    if (empty($_POST["estado"])) {
        $erro_estado = "Informe o estado (UF)";
    } else {
        $estado = $_POST["estado"];
    }

    //Endereço
    if (empty($_POST["endereco"])) {
        $erro_endereco = "Por favor, informe o endereço";
    } else {
        $endereco = $_POST["endereco"];
    }

    //CEP
    if (empty($_POST["cep"])) {
        $erro_cep = "O CEP é necessário";
    } else {
        $cep = $_POST["cep"];
    }

    //Verificação Geral de Erros
    //Dessa vez, vou verificar  diretamente se alguma variável de erro está preenchida e assim prosseguir
    //Se todas as variáveis de erro estiverem vazias, não existem erros e podemos prosseguir numa boa
    if (empty($erro_nome) && 
    empty($erro_email) && 
    empty($erro_idade) && 
    empty($erro_sexo) && 
    empty($erro_cpf) && 
    empty($erro_telefone) && 
    empty($erro_cidade) && 
    empty($erro_estado) && 
    empty($erro_endereco) && 
    empty($erro_cep)) {

        //Se não houver erros, salvamos os dados na sessão para usarmos depois
        //Um array que vai salvar os dados do cliente para que possamos usa-los na próxima etapa
        $_SESSION['cliente'] = [
            'nome'       => $nome,
            'email'      => $email,
            'idade'      => $idade,
            'sexo'       => $sexo,
            'cpf'        => $cpf,
            'telefone'   => $telefone,
            'cidade'     => $cidade,
            'estado'     => $estado,
            'endereco'   => $endereco,
            'cep'        => $cep
        ];

        //Redireciona para a próxima etapa usando o nome do próximo arquivo
        header("Location: Etapa - 2.php");
        exit(); //É uma boa prática para parar o script após terminarmos tudo
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title>Dados do Aluno</title>
    <style>
        /* Estilização básica para os campos de erro, se desejar */
        .erro {
            color: #FFBABA;
            font-size: 0.9em;
        }
    </style>
</head>
<body bgcolor="#b9ffff" style="color: black;">
    <form method="POST" action="Etapa - 1.php">
        <h1 style="text-align: center; margin: 0; padding: 0">Cadastro do Aluno</h1><br>

        <fieldset style="width: 50%; margin: 0 auto;">

            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" size="50" maxlength="40" value="<?php echo htmlspecialchars($nome);?>">
            <span class="erro" style="color: red;"><?php echo $erro_nome;?></span><br><br>

            <label for="email">Email:</label><br> <input type="email" id="email" name="email" size="50" maxlength="100" value="<?php echo htmlspecialchars($email);?>">
            <span class="erro" style="color: red;"><?php echo $erro_email;?></span><br><br> <!-- O Type Email garante que ele precisa do @ -->

            <label for="idade">Idade:</label><br> <input type="text" id="idade" name="idade" size="50" maxlength="3" value="<?php echo htmlspecialchars($idade);?>">
            <span class="erro" style="color: red;"><?php echo $erro_idade;?></span><br><br>

            <label for="sexo">Sexo (M/F):</label><br>
            <input type="text" id="sexo" name="sexo" size="50" maxlength="1" value="<?php echo htmlspecialchars($sexo);?>">
            <span class="erro" style="color: red;"><?php echo $erro_sexo;?></span><br><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" size="50" maxlength="14" value="<?php echo htmlspecialchars($cpf);?>">
            <span class="erro" style="color: red;"><?php echo $erro_cpf;?></span><br><br>

            <label for="telefone">Telefone:</label><br> <input type="tel" id="telefone" name="telefone" size="50" maxlength="15" value="<?php echo htmlspecialchars($telefone);?>">
            <span class="erro" style="color: red;"><?php echo $erro_telefone;?></span><br><br>

            <label for="endereco">Endereço:</label><br>
            <input type="text" id="endereco" name="endereco" size="50" maxlength="100" value="<?php echo htmlspecialchars($endereco);?>">
            <span class="erro" style="color: red;"><?php echo $erro_endereco;?></span><br><br>

            <label for="cidade">Cidade:</label><br>
            <input type="text" id="cidade" name="cidade" size="50" maxlength="50" value="<?php echo htmlspecialchars($cidade);?>">
            <span class="erro" style="color: red;"><?php echo $erro_cidade;?></span><br><br>

            <label for="estado">Estado (UF):</label><br>
            <input type="text" id="estado" name="estado" size="50" maxlength="2" value="<?php echo htmlspecialchars($estado);?>">
            <span class="erro" style="color: red;"><?php echo $erro_estado;?></span><br><br>

            <label for="cep">CEP:</label><br>
            <input type="text" id="cep" name="cep" size="50" maxlength="9" value="<?php echo htmlspecialchars($cep);?>">
            <span class="erro" style="color: red;"><?php echo $erro_cep;?></span><br><br>

        </fieldset><br>

        <div style="display: flex; gap:20px; justify-content: center">
            <input type="submit" value="Próximo" style="cursor: pointer">
        </div>
    </form>
</body>
</html>