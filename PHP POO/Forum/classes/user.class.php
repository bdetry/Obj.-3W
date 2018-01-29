<?php


class User {
    
    //Propietes
    
    private $id;
    private $email;
    private $prenom;
    private $nom;
    
    //Contruct
    
    //Setters
    
     public function setId($value)
    {
        $this-> id= $value;
    }
    
    
    public function setEmail($value)
    {
        $this->email = $value;
    }
    
    public function setPrenom($value)
    {
        $this->prenom = $value;
    }
    
    public function setNom($value)
    {
        $this->nom = $value;
    }
    
    
    //Getters
    
    
    public function getId()
    {
        return $this->id;
    }
    
    
    public function getEmail()
    {
       return $this->email;
    }
    
    public function getPrenom()
    {
        return $this->prenom;
    }
    
    public function getNom()
    {
        return $this->nom;
    }
    
    //Methodes
    
    //publie message dans une conv
    
    public function postMsg($convID, $userID, $con)
    {
        if(userModal::postMesg($convID, $userID, $con))
        {
           return true;
        }
            return false;
        
    }
    
    public function connectUser($email, $pass)
    {
        if(userModal::makeSession($email))
        {
            return true;
        }
        return false;
    }
    
    //Destoy
    
}