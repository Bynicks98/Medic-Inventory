<?php

class cconexion {

    public static function getConexion() {
        $host = "DESKTOP-P3OGUBB\\SQLEXPRESS";
        $dbname = "dbprueba";
        $username = "sa";
        $password = "12345";

        try {
            $conn = new PDO("sqlsrv:server=$host;database=$dbname", $username, $password);
            
        } catch (PDOException $exp) {
            echo "no se logró conectar correctamente";
        }

        return $conn;
    }
}