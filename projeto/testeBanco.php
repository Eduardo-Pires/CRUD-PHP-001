<?php
require_once "Pessoa.php";
require_once "PessoaRepository.php";


    $person = new Pessoa(null, null, "05002012007", 10);

    $repository = new PessoaRepository();
    $repository->atualizarPessoa($person);
    print_r($person);