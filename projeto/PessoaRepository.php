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
        $sql = <<<SQL
            INSERT INTO Pessoa (nome, email, telefone)
            VALUES (?,?,?)
        SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$pessoa->getnome(), $pessoa->getEmail(), $pessoa->getTelefone()]);
        $pessoa->setId($this->pdo->lastInsertId());
    }

    public function listarPessoas()
    {
        // TODO: Implement ListarPessoas() method.
    }

    public function obterPessoaPorId($id)
    {
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
    }

    public function atualizarPessoa($pessoa)
    {
        $nome = $pessoa->getNome();
        $email = $pessoa->getEmail();
        $telefone = $pessoa->getTelefone();
        $id = $pessoa->getId();

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
                throw new Exception('Falha ao atualizar pessoa');
            }
            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                throw new Exception("Registro com ID $id não encontrado no banco de dados.");
            }
        }
    }

    public function excluirPessoa($id)
    {
        // TODO: Implement ExcluirPessoa() method.
    }
}