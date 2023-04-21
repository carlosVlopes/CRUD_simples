<?php

    require_once 'DAO/UsuarioDAO.php';

    if(isset($_POST['btnAcessar'])){
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $dao = new UsuarioDAO();
        $ret = $dao->VerificarLogin($nome,$senha);
        if($ret == -1){
            $msg = 'Preencha o campo nome!';
        }
        elseif($ret == -2){
            $msg = 'Preencha o campo senha!';
        }
        elseif($ret == -3){
            $msg = 'Nome ou Senha errado!';
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
    <title>Login Usuário</title>
</head>
<body>
    <div class="main">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <span><?= isset($msg) ? $msg : '' ?></span><hr>
            <label>Nome: </label><br>
            <input type="text" name="nome" placeholder="Coloque seu nome aqui" value="<?= isset($nome) ? $nome : '' ?>"><br>
            <label>Senha: </label><br>
            <input type="password" name="senha" placeholder="Coloque sua senha aqui!" value="<?= isset($senha) ? $senha : '' ?>"><br>
            <button name="btnAcessar">ACESSAR</button>
            <a href="cadastro.php">Cadastre-se...</a>
        </form>
    </div>
</body>
</html>