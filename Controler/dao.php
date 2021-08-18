<?php

require_once '../Conexao/conexao.php';
require_once '../Model/CLPP.php';

class Dao
{
    public function Select()
    {
        try {
            $conexao = new Connect();
            $consulta = $conexao->Conectando()->prepare("SELECT * FROM cl_response");
            $consulta->execute();
            $resposta = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }


    public function Insert(Checklist $checklist)
    {
 
        try {
            $conexao = new Connect();
            $a = $checklist->getId();
            $b = $checklist->getUser();
            $c = $checklist->getDescription();
            $d = $checklist->getType();
            $f = $checklist->getPhoto();

            $consulta = $conexao->Conectando()->prepare('INSERT INTO cl_response (id_option, user, descricao,  type, photo)  VALUES (:id, :user, :description,:type, :photo)');
            $consulta->bindValue(':id', $a,);
            $consulta->bindValue(':user',$b, );
            $consulta->bindValue(':description',$c, );
            $consulta->bindValue(':type',$d, ); 
            $consulta->bindValue(':photo',$f, ); 
            
           
            return $consulta->execute();

        } catch (PDOException $erro) {
            return $erro;
        }
    }

    public function Update($id, $a, $b, $c, $d, $e, $f)
    {
        try {
            $conexao = new Connect();
            $consulta = $conexao->Conectando()->prepare("UPDATE cl_response SET ID_option = '$a', descr = '$b', photo = '$c', dataa ='$d', TYPEE = '$e', USERR = '$f' WHERE ID = '$id'");
            return $consulta->execute();
        } catch (PDOException $erro) {
            return $erro;
        }
    }

    public function Delete($id)
    {
        try {
            $conexao = new Connect();
            $consulta = $conexao->Conectando()->prepare("DELETE FROM cl_response WHERE ID= '$id'");
            return $consulta->execute();
        } catch (PDOException $erro) {
            return $erro;
        }
    }
}
