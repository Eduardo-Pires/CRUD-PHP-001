<?php
    require_once "./controllers/PessoasController.php";
    $controller = new PessoasController();
    $action = !empty($_GET['a']) ? $_GET['a'] : 'listarPessoas';
    $controller->$action();
