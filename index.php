<?php

    require_once 'DAO/UsuarioDAO.php';
    $dao = new UsuarioDAO();
    $ret = $dao->ConsultarUsuarios();

    if(isset($_POST['btnExcluir'])){
        $id_usuario = $_POST['id_usuario'];
        $nome = $_POST['nome'];
        $dao = new UsuarioDAO();
        $exs = $dao->ExcluirUsuario($id_usuario);
        if($exs == 1){
            $msg = "Usuário " . $nome . " deletado com sucesso!";
        }
    }

    $ret = $dao->ConsultarUsuarios();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Index.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <h1>Tabela de Usuários</h1>
        <span><?= isset($msg) ? $msg : '' ?></span>
        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Senha</th>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <form action="index.php" method="post">
                    <?php for($i = 0; $i < count($ret); $i++){ ?>
                        <tr>
                            <td><?= $ret[$i]['nome_usuario']?></td>
                            <td><?= $ret[$i]['senha_usuario']?></td>
                            <td><?= $ret[$i]['data_cadastro']?></td>
                            <input type="hidden" name="id_usuario" value="<?= $ret[$i]['id_usuario']?>" >
                            <input type="hidden" name="nome" value="<?= $ret[$i]['nome_usuario']?>" >
                            <td><a href="alterar_usuario.php?cod=<?= $ret[$i]['id_usuario']?>">ALTERAR<a/> <button name="btnExcluir">EXCLUIR</button></td>
                        </tr>
                    <?php } ?>
                </form>
            </tbody>
        </table>
    </div>
</body>
</html>