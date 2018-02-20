<?php


class ClassMessage {
    
    private $id;
    private $date;
    private $heure;
    private $nomPrenom;
    private $msg;
    
    public function __construct($id , $date, $heure, $nom, $msg) 
    {
        $this->setId($id);
        $this->setDate($date);
        $this->setHeure($heure);
        $this->setNom($nom);
        $this->setMsg($msg);
    }
    
    public function setId($value)
    {
        $this->id = $value;
    }
    
    public function setDate($value)
    {
        $this->date = substr($value,0,10);
    }
    
    public function setHeure($value)
    {
        $this->heure = substr($value,11,8);
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