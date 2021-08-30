<?php

namespace Model\CLPP;

class UserCheckList
{
    function __construct(
        $id_user,
        $id_checklist
    ) {
        $this->id_user = (int)$id_user;
        $this->id_checklist = (int)$id_checklist;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = (int)$id_user;
        return $this;
    }

    public function getIdChecklist()
    {
        return $this->id_checklist;
    }

    public function setIdChecklist($id_checklist)
    {
        $this->checklist = $id_checklist;
        return $this;
    }
}
