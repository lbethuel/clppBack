<?php

use Model\CLPP\Checklist;

require_once(dirname(__DIR__) . '../../Services/Connection.php');


class DaoChecklist
{
  function SelectChecklist($id)
  {
    try {
      $connection = new Connection();
      $response = $connection->Select(
        "SELECT c.id, c.description, d.name, c.date_init,  c.date_final FROM cl_checklist c  
      left join cl_user_checklist a on a.id_checklist= c.id
      left join cl_groups_employees b on b.id_checklist = c.id
      left join _employee d on d.id = c.id_user_create
      where b.id_user=? AND (( CURRENT_DATE() between c.date_init and c.date_final) or c.date_init is null and c.date_final is null )  or a.id_user=?  
      AND (( CURRENT_DATE() between c.date_init and c.date_final) or c.date_init is null or c.date_final is null );",
        [$id, $id]

        /* "SELECT c.id, c.date_final,c.date_init, c.description, u.user FROM cl_checklist c 
      inner join cl_groups_employees g on c.id = g.id_checklist
      inner join _user u on c.id_user_create = u.id
      where g.id_user=? AND ( CURRENT_DATE() between c.date_init and c.date_final) OR g.id_user=? AND c.date_init is NULL and c.date_final is NULL",[$id, $id] */
      );
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }

  function SelectQuestion($id)
  {
    try {
      $connection = new Connection();
      $response = $connection->Select(
        "SELECT count(id) question from cl_question where id_checklist = ?",
        [$id]
      );
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }

  function SelectChecklistAll($id)
  {
    try {
      $connection = new Connection();
      $response = $connection->Select(
        "SELECT c.id, c.date_final,c.date_init, c.description, u.user FROM cl_checklist c 
      inner join cl_groups_employees g on c.id = g.id_checklist
      inner join _user u on c.id_user_create = u.id
      where g.id_user=?",
        [$id]
      );
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }

  function Select($id)
  {
    try {
      $connection = new Connection();
      $response = $connection->Select("SELECT * from cl_checklist where id_user_create=?", [$id]);
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }

  function Insert(Checklist $checklist)
  {
    try {
      $connection = new Connection();
      $response = $connection->Insert(
        "INSERT INTO `cl_checklist` (`description`, `date_init`, `date_final`, `notification`, `id_user_create`) VALUES (?,?,?,?,?);",
        [
          $checklist->getDescription(),
          $checklist->getDateInit(),
          $checklist->getDateFinal(),
          $checklist->getNotification(),
          $checklist->getIdCreator()
        ]
      );
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }


  function Update(Checklist $checklist)
  {
    try {
      $connection = new Connection();
      $response = $connection->Update(
        "UPDATE `cl_checklist` SET `description`=? , `date_init`=?, `date_final`=?, `notification`=? `id_user_create`=? WHERE id=?",
        [
          $checklist->getDescription(),
          $checklist->getDateInit(),
          $checklist->getDateFinal(),
          $checklist->getNotification(),
          $checklist->getIdCreator(),
          $checklist->getId()
        ]
      );
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }

  function Delete($id)
  {
    try {
      $connection = new Connection();
      $response = $connection->Delete(
        "DELETE FROM `cl_checklist` WHERE (`id` = ?);",
        [$id]
      );
      return $response;
    } catch (Exception $e) {
      return $e;
    }
  }
}
