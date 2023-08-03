<?php

require_once "models/PessoaRepository.php";
require_once "models/Pessoa.php";

/*essa classe tem por responsabilidade fazer a comunicação entre os models e os views, sendo um intermediario
 *que também prepara os dados para que funcionem da forma correta
 */
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
            $error = array(
                "status" => "error",
                "message" => $e->getMessage()
            );
            header('Content-Type: application/json; charset=utf-8');
            exit(json_encode($error));
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

                $mensagem = "Pessoa criada com sucesso";
                $dados = array(
                    "status" => "success",
                    "message" => $mensagem
                );

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dados);
            }catch (Exception $e){
                $this->model->rollBackPDO();
                $error = array(
                    "status" => "error",
                    "message" => $e->getMessage()
                );
                header('Content-Type: application/json; charset=utf-8');
                exit(json_encode($error));
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
                    "status" => "success",
                    "message" => $mensagem
                );

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dados);
            }catch (Exception $e){
                $this->model->rollBackPDO();
                $error = array(
                    "status" => "error",
                    "message" => $e->getMessage()
                );
                header('Content-Type: application/json; charset=utf-8');
                exit(json_encode($error));
            }
        } 
    }

    public function excluirPessoa($access = true, $id= null)
    {
        if($access)
        {
            require_once('views/excluirPessoaView.html');
        }
        else
        {
            try {

                $this->model->excluirPessoa($id);

                $mensagem = "Pessoas excluída com sucesso";
                $dados = array(
                    "status" => "success",
                    "message" => $mensagem
                );

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dados);
            }catch (Exception $e){
                $this->model->rollBackPDO();
                $error = array(
                    "status" => "error",
                    "message" => $e->getMessage()
                );
                header('Content-Type: application/json; charset=utf-8');
                exit(json_encode($error));
            }
        }
    }

    public function obterPessoaPorId($access = true, $id= null)
    {
        if($access)
        {
            require_once('views/obterPessoaPorIdView.html');
        }
        else
        {
            try {

                $pessoa = $this->model->obterPessoaPorId($id);
                $dados = $pessoa->serialize();
                $dados["status"] = "success";

                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dados);
            }catch (Exception $e){
                $error = array(
                    "status" => "error",
                    "message" => $e->getMessage()
                );
                header('Content-Type: application/json; charset=utf-8');
                exit(json_encode($error));
            }
        }
    }
}