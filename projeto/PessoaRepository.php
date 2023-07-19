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
            exit('Falha no cadastro da pessoa'. $e->getMessage());
        }
    }

    public function listarPessoas()
    {
        // TODO: Implement ListarPessoas() method.
    }

    public function obterPessoaPorId($id)
    {
        // TODO: Implement ObterPessoaPorId() method.
    }

    public function atualizarPessoa($pessoa)
    {
        // TODO: Implement AtualizarPessoa() method.
    }

    public function excluirPessoa($id)
    {
        // TODO: Implement ExcluirPessoa() method.
    }
}