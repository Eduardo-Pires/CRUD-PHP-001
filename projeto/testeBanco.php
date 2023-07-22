<?php
require_once "Pessoa.php";
require_once "PessoaRepository.php";

try {
   // $person = new Pessoa(null, null, "05002012007", 10);

    $repository = new PessoaRepository();
    $pessoas = $repository->listarPessoas();
    $repository->excluirPessoa(7);
    print_r($pessoas);
} catch (Exception $e) {
    exit($e->getMessage());
}
