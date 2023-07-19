<?php 
    function postgresConnect()
    {
        $db_host = "localhost";
        $db_port = 5432;
        $db_username = "postgres";
        $db_password = "senha";
        $db_name = "postgres";
        $db_schema = "public";

        $dsn = "pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_username;password=$db_password";

        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO($dsn, $db_username, $db_password, $options);
            $pdo->exec("SET search_path TO $db_schema"); 
            return $pdo;
        } catch (Exception $e) {
            exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
        }
    }


?>