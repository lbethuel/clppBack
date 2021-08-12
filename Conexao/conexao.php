<?php

class Connect
{

    public function Conectando()
    {
        $conn = null;
        try {
            $conn = new PDO("mysql:host=localhost; dbname=response", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conectado com sucesso";
        } catch (PDOException $erro) {
            echo "Falha ao conectar: " . $erro->getMessage();
        }
        return $conn;
    }

} 


/*  $a = new Connect;
var_dump($a->Conectando()) ; */

/* try {
    $conn = new PDO("mysql:host=localhost; dbname=response", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado com sucesso";
} catch (PDOException $erro) {
    echo "Falha ao conectar: " . $erro->getMessage();
} */
