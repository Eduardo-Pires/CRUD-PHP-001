<?php
require_once "Pessoa.php";
require_once "PessoaRepository.php";

$person = new Pessoa("Carlão", "Carlão@gmail.com", "89224002");
$repository = new PessoaRepository();
$repository->CriarPessoa($person);
print_r($person);
