<?php

    require_once 'DAO/UsuarioDAO.php';

    if(isset($_POST['btnCadastrar'])){
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $rsenha = $_POST['rsenha'];

        $dao = new UsuarioDAO();
        $ret = $dao->CadastrarUsuario($nome,$senha,$rsenha);
        if($ret == -1){
            $msg = 'Preencha o campo nome!';
        }
        elseif($ret == -2){
            $msg = 'Preencha o campo senha!';
        }
        elseif($ret == -3){
            $msg = 'Preencha o campo repita sua senha!';
        }
        elseif($ret == -4){
            $msg = 'A senha deve conter no minímo 6 caracteres!';
        }
        elseif($ret == -5){
            $msg = 'As senhas deverão ser iguais!';
        }
        elseif($ret == -6){
            $msg = 'Esse usuário já existe, coloque outro nome!';
        }
        elseif($ret == 1){
            $msg = 'Usuário cadastrado com sucesso!';
        }
        else{
            $msg = 'Ocorreu algum erro na operação!';
        }
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Style.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <div class="main">
        <form action="cadastro.php" method="post">
            <h2>Cadastrar Usuário</h2>
            <span><?= isset($msg) ? $msg : '' ?></span><hr>
            <label>Nome: </label><br>
            <input type="text" name="nome" placeholder="Coloque seu nome aqui!" value="<?= isset($nome) ? $nome : '' ?>"><br>
            <label>Senha: </label><br>
            <input type="password" name="senha" placeholder="Coloque sua senha aqui!" value="<?= isset($senha) ? $senha : '' ?>"><br>
            <label>Repita sua senha: </label><br>
            <input type="password" name="rsenha" placeholder="Repita sua senha aqui!" value="<?= isset($rsenha) ? $rsenha : '' ?>"><br>
            <button name="btnCadastrar">CADASTRAR</button>
            <a href="login.php">Fazer login...</a>
        </form>
    </div>
</body>
</html>