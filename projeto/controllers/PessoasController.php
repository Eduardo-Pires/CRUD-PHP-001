<?php

require_once "models/PessoaRepository.php";

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
            $pessoasJson = [];
    
            foreach ($pessoas as $pessoa) {
                $pessoas[] = $pessoa->serialize();
            }

            require_once ('views/listarPessoas.php');
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function criarPessoa($access = true, $nome, $email, $telefone)
    {
        if($access)
        {
            require_once('views/CriarPessoa.php');
        }
        else
        {
            echo 'batata';
        }
        
    }


}