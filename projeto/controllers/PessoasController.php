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
        $pessoas = $this->model->listarPessoas();
        $pessoasJson = [];

        foreach ($pessoas as $pessoa) {
            $pessoasJson[] = $pessoa->jsonSerialize();
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($pessoasJson);
    }


}