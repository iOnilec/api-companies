<?php

if (!function_exists('connect')) {
    function connect()
    {
        $host = 'db';
        $port = '5432';
        $dbname = 'api_companies';
        $user = 'admin';
        $password = 'admin';

        try {
            $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (Exception $e) {

            die("Erro na conexão com o banco de dados \n" . $e->getMessage());
        }
    }
}

connect();
