<?php

namespace Model\CLPP;

class Response
{
function __construct(
    $id_option,
    $description,
    $date,
    $type,
    $user,
    $photo
  ){
    $this->id_option = (int)$id_option;
    $this->description = $description;
    $this->date = $date;
    $this->type = $type;
    $this->user = (int)$user;
    $this->photo = $photo;
  }

public function getId()
{
  
  return $this->id_option;
}

public function setId($id_option)
  {
    $this->id_option = (int)$id_option;
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

  public function getDate()
  {
    return $this->date;
  }

  public function setDate($date)
  {
    $this->date = $date;
    return $this;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setType($type)
  {
    $this->type = $type;
    return $this;
  }

  public function getUser()
  {
    return $this->user;
  }

  public function setUser($user)
  {
    $this->user = $user;
    return $this;
  }

  public function getPhoto()
  {
    return $this->photo;
  }

  public function setPhoto($photo)
  {
    $this->photo = $photo;
    return $this;
  }
}


