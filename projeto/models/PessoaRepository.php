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

    //recebe um objeto pessoa sem o ID definido, cria uma linha no banco e devolve o objeto completo,
    //apesar de esta função não estar sendo utilizada achei importante para a escalabilidade do projeto
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

    //adiciona todas as linhas da tabela em um array de objetos Pessoa
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

    //Obtem uma pessoa pelo seu ID, em especial tem um tratamento de erro para caso não exista a pessoa
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
            if(!$stmt->execute([$id]))
            {
                throw new Exception("Problemas na obtenção da pessoa");
            }

            $row = $stmt->fetch();
            if (!$row)
            {
                throw new Exception("Pessoa não encontrada");
            }

            return new Pessoa($row['nome'], $row['email'], $row['telefone'], $id);
        }
    }

    // Atualiza uma pessoa com base nos atributos do objeto Pessoa, caso um valor seja nulo, o registro do atributo não é alterado
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

    //exclui um registro da tabela caso seja encontrado o ID
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