<?php

use Model\CLPP\Response;

require_once(dirname(__DIR__) . '../../Services/Connection_UTF8MB4.php');


class Dao
{
    public function Select()
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Select("SELECT * FROM cl_response");
            //$consulta->execute();
            //$resposta = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }


    public function Insert(Response $response)
    {

        try {
            $conexao = new Connection_UTF8MB4();
            
            $consulta = $conexao->Insert(
                "INSERT INTO cl_response (id_option_question, id_user, description,  type, photo, date)  VALUES (?, ?, ?, ?, ?, CURRENT_DATE())",
                [

                    $response->getId(),
                    $response->getUser(),
                    $response->getDescription(),
                    $response->getType(),
                    $response->getPhoto()
                ]
            );
            /* $consulta->bindValue(':id', $a,);
            $consulta->bindValue(':user',$b, );
            $consulta->bindValue(':description',$c, );
            $consulta->bindValue(':type',$d, ); 
            $consulta->bindValue(':photo',$f, );  */




            return $consulta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }

    public function Update($id, $a, $b, $c, $d, $e, $f)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Update("UPDATE cl_response SET id_option = ?, description = ?, photo = ?, data =?, type = ?, user = ? WHERE ID = ?", [$a, $b, $c, $d, $e, $f, $id]);
            //return $consulta->execute();
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }

    public function Delete($id)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Delete("DELETE FROM cl_response WHERE ID= '$id'");
            //return $consulta->execute();
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }
}
