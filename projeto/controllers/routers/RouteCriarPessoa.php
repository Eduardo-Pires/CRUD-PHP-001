<?php 
    require_once "../PessoasController.php";
    $controller = new PessoasController();
 
    $controller->criarPessoa(false, "nome", "email", "telefone");
    

