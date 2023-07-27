<?php

require_once "models/PessoaRepository.php";
require_once "models/Pessoa.php";

class PessoasController
{
    private $model;

    public function __construct()
    {
        $this->model = new PessoaRepository();
    }

    public function listarPessoas()
    {
        try {
            $pessoas = $this->model->listarPessoas();
            $serializedPessoas = [];
    
            foreach ($pessoas as $pessoa) {
                $serializedPessoas[] = $pessoa->serialize();
            }

            require_once ('views/listarPessoasView.php');
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function criarPessoa($access = true, $nome = null, $email = null, $telefone = null)
    {
        if($access)
        {
            require_once('views/criarPessoaView.html');
        }
        else
        {
            try {
                $pessoa = new Pessoa(htmlspecialchars($nome), htmlspecialchars($email), htmlspecialchars($telefone));
                $this->model->criarPessoa($pessoa);

                $mensagem = "Pessoas criada com sucesso";
                $dados = array(
                    "message" => $mensagem
                );

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dados);
            }catch (Exception $e){
                exit($e->getMessage());
            }
        } 
    }

    public function atualizarPessoa($access = true, $nome = null, $email = null, $telefone = null, $id = null)
    {
        if($access)
        {
            require_once('views/atualizarPessoaView.html');
        }
        else
        {
            try {
                $nome = $nome == "empty"? $nome = null : $nome = htmlspecialchars($nome);
                $email = $email == "empty"? $email = null: $email = htmlspecialchars($email);
                $telefone = $telefone == "empty"? $telefone = null: $telefone = htmlspecialchars($telefone);

                $pessoa = new Pessoa($nome, $email, $telefone, $id);
                $this->model->atualizarPessoa($pessoa);

                $mensagem = "Pessoa atualizada com sucesso";
                $dados = array(
                    "message" => $mensagem
                );

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dados);
            }catch (Exception $e){
                exit($e->getMessage());
            }
        } 
    }


}