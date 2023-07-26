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

                header('Content-Type: application/json; charset=utf-8');
                $mensagem = "Pessoas criada com sucesso";
                $dados = array(
                    "status" => "sucesso",
                    "message" => $mensagem
                );

                header('Content-Type: application/json');
                echo json_encode($dados);
            }catch (Exception $e){
                exit($e->getMessage());
            }

        }
        
    }


}