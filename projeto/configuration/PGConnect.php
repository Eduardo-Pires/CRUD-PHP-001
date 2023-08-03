<?php

//classe responsável por conectar o projeto com o banco de dados
class PGConnect
{
    protected $pdo;
    public function __construct()
    {
        $this->postgresConnect();
    }

    public function rollBackPDO()
    {
        $this->pdo->rollBack();
    }

    function postgresConnect()
    {   
        //adicionar os valores caso desejar rodar o projeto, a tabela foi disponibilizada nessa mesma pasta
        $db_host = /*adicionar host*/
        $db_port = /*adicionar port*/
        $db_username = /*adicionar username*/
        $db_password = /*adicionar senha*/
        $db_name = /*adicionar nome do banco*/
        $db_schema = /*adicionar schema do banco*/

        $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_username;password=$db_password";

        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $db_username, $db_password, $options);
            $this->pdo->exec("SET search_path TO $db_schema");
        } catch (Exception $e) {
            exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
        }
    }
}


