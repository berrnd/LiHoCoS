<?php

class DatabaseInstaller {

    function create_database($data, &$errorMessage) {
        $host = $data['hostname'];
        $user = $data['username'];
        $password = $data['password'];
        $database = $data['database'];

        try {
            $pdo = new PDO("mysql:host=$host", $user, $password);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS $database COLLATE latin1_german1_ci");
        } catch (PDOException $ex) {
            $errorMessage = $ex->getMessage();
            return FALSE;
        }

        //Close the connection
        $pdo = NULL;

        return TRUE;
    }

    function create_schema($data, &$errorMessage) {
        $host = $data['hostname'];
        $user = $data['username'];
        $password = $data['password'];
        $database = $data['database'];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $query = file_get_contents('../application/sql/lihocos-dist.sql');
            $pdo->exec($query);
        } catch (PDOException $ex) {
            $errorMessage = $ex->getMessage();
            return FALSE;
        }

        //Close the connection
        $pdo = NULL;

        return TRUE;
    }

}