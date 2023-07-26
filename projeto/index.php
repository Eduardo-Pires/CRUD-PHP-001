<?php
    require "./controllers/PessoasController.php";
    $controller = new PessoasController();
    $action = !empty($_GET['a']) ? $_GET['a'] : 'listarPessoas';

    if(!empty($_GET['nome']) and !empty($_GET['email']) and !empty($_GET['telefone']))
    {
        $controller->$action(false, $_GET['nome'], $_GET['email'], $_GET['telefone']);
    }
    else
    {
        $controller->$action();
    }

