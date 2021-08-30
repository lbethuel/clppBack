<?php

use Model\CLPP\UserCheckList;

require_once(dirname(__DIR__) . '../../Services/Connection_UTF8MB4.php');



class DaoUserChecklist
{


    public function SelectCheckList($id_checklist)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Select("SELECT * FROM cl_user_checklist WHERE id_checklist=?", [$id_checklist]);
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }

    public function SelectUser($id_users)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Select("SELECT * FROM cl_user_checklist where id_user=?", [$id_users]);
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }

     public function SelectAll($id_users, $id_checklist)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Select("SELECT * FROM cl_user_checklist
            WHERE id_user = ? and id_checklist = ?", [$id_users, $id_checklist]);
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    } 


    public function Insert(UserChecklist $userChecklist)
    {
        try {
            $conexao = new Connection_UTF8MB4();

            $resposta = $conexao->Insert(
                "INSERT INTO cl_user_checklist (id_user, id_checklist) VALUES (?,?); /* (SELECT 1 FROM cl_user_checklist WHERE id_user = ? AND id_checklist = ?) */",
                [
                    $userChecklist->getIdUser(),
                    $userChecklist->getIdChecklist()
                ]
               
                
            );

            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }


    public function DeleteUser($id_user,$id_checklist)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Delete(
                "DELETE FROM `cl_user_checklist` WHERE (`id_user`= ? and id_checklist=?);",
                [$id_user,$id_checklist]
            );
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }
    }

    public function DeleteCheckList($id_checklist)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Delete(
                "DELETE FROM `cl_user_checklist` WHERE (`id_checklist` = ?);",
                [$id_checklist]
            );
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }



        /* public function Delete($id_user, $id_checklist)
    {
        try {
            $conexao = new Connection_UTF8MB4();
            $resposta = $conexao->Delete(
                "DELETE FROM `cl_user_checklist` WHERE `id_user` = ? AND `id_checklist` = ?",
                [
                    $id_user,
                    $id_checklist
                ]
            );
            return $resposta;
        } catch (PDOException $erro) {
            return $erro;
        }*/
    }
}
