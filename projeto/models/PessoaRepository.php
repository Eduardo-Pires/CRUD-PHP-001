<?php
require_once "Pessoa.php";
require_once "IPessoaRepository.php";
require_once "configuration/pgConnection.php";

class PessoaRepository extends PGConnect  implements IPessoaRepository
{
    public function __construct()
    {
        parent::__construct();
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
        $sql = <<<SQL
            SELECT id, nome, email, telefone
            FROM pessoa
        SQL;

        $pessoas = [];
        $stmt = $this->pdo->query($sql);
        while ($row = $stmt->fetch()) {
            $pessoas[] = new Pessoa($row['nome'], $row['email'], $row['telefone'], $row['id']);
        }

        return $pessoas;
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
            if(!$stmt->execute($id))
            {
                throw new Exception("Problemas na obtenção da pessoa");
            }

            $row = $stmt->fetch();
            if (!$row)
            {
                return false;
            }

            return new Pessoa($row['nome'], $row['email'], $row['telefone'], $id);
        }
    }

    public function atualizarPessoa($pessoa)
    {

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
            if(!$stmt->execute([$pessoa->getNome(), $pessoa->getEmail(), $pessoa->getTelefone() ,$pessoa->getId()]))
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
        if($id == null)
        {
            throw new Exception("ID com valor ilegal: NULL");
        }
        else {
            $sql = <<<SQL
                DELETE  FROM pessoa
                WHERE id = ?
            SQL;

            $stmt = $this->pdo->prepare($sql);
            if(!$stmt->execute([$id]))
            {
                throw new Exception("Problemas na deleção da pessoa");
            }
            $rowCount = $stmt->rowCount();
            if ($rowCount === 0) {
                throw new Exception("Registro com ID $id não encontrado no banco de dados.");
            }
        }
    }
}