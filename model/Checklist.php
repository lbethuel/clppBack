<?php

namespace Model\CLPP;

class Checklist
{
  function __construct(
    $id,
    $description,
    $date_init,
    $date_final,
    $notification,
    $creator
  ) {
    $this->id = (int)$id;
    $this->description = $description;
    $this->date_init = $date_init;
    $this->date_final = $date_final;
    $this->notification = (int)$notification;
    $this->id_creator = (int)$creator;
  }


  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = (int)$id;
    return $this;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;
    return $this;
  }

  public function getDateInit()
  {
    return $this->date_init;
  }

  public function setDateInit($date_init)
  {
    $this->date_init = $date_init;
    return $this;
  }

  public function getDateFinal()
  {
    return $this->date_final;
  }

  public function setDateFinal($date_final)
  {
    $this->date_final = $date_final;
    return $this;
  }


  public function getNotification()
  {
    return $this->notification;
  }

  public function setNotification($notification)
  {
    $this->notification = (int)$notification;
    return $this;
  }

  public function getIdCreator()
  {
    return $this->id_creator;
  }

  public function setIdCreator($creator)
  {
    $this->id_creator = (int)$creator;
    return $this;
  }

}
