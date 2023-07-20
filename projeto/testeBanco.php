<?php
require_once "Pessoa.php";
require_once "PessoaRepository.php";

    $person = new Pessoa("Carla", "Carla@gmail.com", "892402");

    $repository = new PessoaRepository();
    $repository->CriarPessoa($person);
    $p = $repository->obterPessoaPorId(1);
    print_r($p);
    print_r($person);