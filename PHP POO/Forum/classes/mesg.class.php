<?php


class Mesg {
    
    private $id;
    private $date;
    private $heure;
    private $nomPrenom;
    private $msg;
    
    public function setId($value)
    {
        $this->id = $value;
    }
    
    public function setDate($value)
    {
        $this->date = $value;
    }
    
    public function setHeure($value)
    {
        $this->heure = $value;
    }
    
    public function setNom($value)
    {
        $this->nomPrenom = $value;
    }

    public function setMsg($value)
    {
        $this->msg = $value;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getHeure()
    {
        return $this->heure;
    }
    
    public function getNomPren()
    {
        return $this->nomPrenom;
    }
    
    public function getMsg()
    {
        return $this->msg;
    }
    
    public function __toString()
    {
        return '
        <tr>
        <td>'.$this->getDate().' <br> ID : '.$this->getId().'</td>
        <td>'.$this->getHeure().'</td>
        <td>'.$this->getNomPren().'</td>
        <td>'.$this->getMsg().'</td>
        </tr>
        ';
    }
    
}