<?php
require_once "Pessoa.php";
require_once "IPessoaRepository.php";
require_once "pgConnection.php";

class PessoaRepository implements IPessoaRepository
{
    Private $pdo;

    public function __construct()
    {
        $this->pdo = postgresConnect();
    }

    public function criarPessoa($pessoa)
    {
        try{
            $sql = <<<SQL
                INSERT INTO Pessoa (nome, email, telefone)
                VALUES (?,?,?)
            SQL;

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$pessoa->getnome(), $pessoa->getEmail(), $pessoa->getTelefone()]);
            $pessoa->setId($this->pdo->lastInsertId());
        }catch (Exception $e){
            return('Falha no cadastro da pessoa, '. $e->getMessage());
        }
    }

    public function listarPessoas()
    {
        // TODO: Implement ListarPessoas() method.
    }

    public function obterPessoaPorId($id)
    {
        try{
            if($id == null)
            {
                throw new Exception("ID com valor ilegal: NULL");
            }
            else
            {
                $sql = <<<SQL
                    SELECT nome, email, telefone
                    FROM pessoa
                    WHERE id = ?
                SQL;

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($id);

                $row = $stmt->fetch();
                return new Pessoa($row['nome'], $row['email'], $row['telefone'], $id);
            }

        }catch (Exception $e){
            return('Falha ao obter pessoa, '. $e->getMessage());
        }
    }

    public function atualizarPessoa($pessoa)
    {
        $nome = $pessoa->getNome();
        $email = $pessoa->getEmail();
        $telefone = $pessoa->getTelefone();
        $id = $pessoa->getId();
        try{
            if($id == null)
            {
                throw new Exception("ID com valor ilegal: NULL");
            }
            else
            {
                $sql = <<<SQL
                    UPDATE pessoa
                    SET nome = COALESCE(?, nome), email = COALESCE(?, email), telefone = COALESCE(?, telefone)
                    WHERE id = ?
                SQL;

                $stmt = $this->pdo->prepare($sql);
                if(!$stmt->execute([$nome, $email, $telefone ,$pessoa->getId()]))
                {
                    throw new Exception('Falha ao atualizar pessoa, verificar se valor de ID está correto');
                }
            }


        }catch (Exception $e){
            return($e->getMessage());
        }
    }

    public function excluirPessoa($id)
    {
        // TODO: Implement ExcluirPessoa() method.
    }
}