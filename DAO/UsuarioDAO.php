<?php
// sistema de login, cadastro, alterar e excluir do usuario.

    require_once 'conexao.php';
    require_once 'UtilDAO.php';

    class UsuarioDAO extends Conexao{

        public function VerificarLogin($nome,$senha){
            if(trim($nome) == ''){
                return -1;
            }
            elseif(trim($senha) == ''){
                return -2;
            }
            else{
                $conexao = parent::retornarConexao();
                $comando_sql = 'select nome_usuario, senha_usuario
                                from tb_usuarios
                                where nome_usuario = ?
                                and senha_usuario = ?';
                $sql = new PDOStatement();
                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1,$nome);
                $sql->bindValue(2,$senha);
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                $sql->execute();
                $user = $sql->fetchAll();
                if(count($user) == 0){
                    return -3;
                }
                else{
                    $cod = $user[0]['id_usuario'];
                    $nome = $user[0]['nome_usuario'];
                    header('location: index.php');
                    exit;
                }
            }
        }

        public function VerificarNomeDuplicado($nome){
            if(trim($nome) == ''){
                return 0;
            }
            else{
                $conexao = parent::retornarConexao();
                $comando_sql = 'select count(nome_usuario) as contar from tb_usuarios
                                where nome_usuario = ?';
                $sql = new PDOStatement();
                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1,$nome);
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                $sql->execute();
                $contar = $sql->fetchAll();
                return $contar[0]['contar'];
            }
        }

        public function CadastrarUsuario($nome,$senha,$rsenha){
            if(trim($nome) == ''){
                return -1;
            }
            elseif(trim($senha) == ''){
                return -2;
            }
            elseif(trim($rsenha) == ''){
                return -3;
            }
            elseif(strlen($senha) < 6){
                return -4;
            }
            elseif(trim($rsenha) != trim($senha)){
                return -5;
            }
            elseif($this->VerificarNomeDuplicado($nome) != 0){
                return -6;
            }
            else{
                $conexao = parent::retornarConexao();
                $comando_sql = 'insert into tb_usuarios(nome_usuario,senha_usuario,data_cadastro)
                                values (?,?,?)';
                $sql = new PDOStatement();
                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1,$nome);
                $sql->bindValue(2,$senha);
                $sql->bindValue(3, UtilDAO::DataCadastro());
                try {
                    $sql->execute();
                    return 1;
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    return 0;
                }
            }
        }

        public function ConsultarUsuarios(){
            $conexao = parent::retornarConexao();
            $comando_sql = 'select nome_usuario,
                                   id_usuario,
                                   senha_usuario,
                                   date_format(data_cadastro, "%d/%m/%Y") as data_cadastro
                            from tb_usuarios';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }

        public function ExcluirUsuario($id_usuario){
            $conexao = parent::retornarConexao();
            $comando_sql = 'delete from tb_usuarios
                            where id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1,$id_usuario);
            $conexao->beginTransaction();
            try{
                $sql->execute();
                $conexao->commit();
                return 1;
            }
            catch(Exception $ex){
                $conexao->rollBack();
                echo $ex->getMessage();
                return 0;
            }
        }

    }


?>