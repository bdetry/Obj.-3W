<?php

//cette function cherche l'element concerne ou tous les elements du tableu concernce
// param d'entre : $bdd , $tab , [$elemnt_id]
//retourne un array avec toute les donnes de tab si $elemnt_id est abst // toutes les donnes de $elemnt_id si present
//retourne false en cas d'erreur

function vaChercher($bdd , $tab , $elemnt_id = NULL)
{
    if(!in_array($tab , array("nain", "ville", "taverne", "groupe", "tunnel")))
    {
        return FALSE;
    }

    switch($tab)
    {
        case "nain" : $id = "n_id"; break;
        case "ville" :  $id = "v_id"; break;
        case "taverne" : $id = "t_id"; break;
        case "groupe" :  $id = "g_id"; break;
        case "tunnel" : $id = "t_id"; break;
    }
    
    if($elemnt_id==NULL)
    {
        try
        {                        
            if(($resource = $bdd->query('SELECT * FROM '.$tab))!==FALSE)
            {
                if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                   return $data;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        } 
    }
    else
    {
        if(($resource = $bdd->prepare('SELECT * FROM '.$tab.' WHERE '.$id.' = :id'))!==FALSE)
        {
            if($resource->bindValue('id' , $elemnt_id))
            {
                if($resource->execute())
                {
                    if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                    {
                              return  $array;
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                 return FALSE;
            }
        }
        else
        {
            return FALSE;
        } 
    }
}


//retourne tout les nains existants ou l'info d'un nain en paritculier
// optionel : n_id -> si absent tout les nains sont retournes
//return array avec nain_id, nain_nom, n_barbe, n_groupe_fk , n_ville_fk

function nain($bdd, $nain_id=NULL)
{
  return vaChercher($bdd , "nain" , $nain_id);
}

//retourne toutes les villes existants ou l'info d'une ville en paritculier
// optionel : v_id -> si absent toutes les villes sont retournes
//return array avec v_id, v_nom, v_superficie

function ville($bdd, $ville_id=NULL)
{
    return vaChercher($bdd , "ville" , $ville_id);
}

//retourne toutes les tavernes existants ou l'info d'une taverne en paritculier
// optionel : v_id -> si absent toutes les tavernes sont retournes
//return array avec t_id, t_nom, t_nom, t_chambres, t_blonde, t_brune, t_rousse , t_ville_fk

function taverne($bdd, $tav_id=NULL)
{
    if($tav_id=="none")
    {
        return FALSE;    
    }    
    return vaChercher($bdd , "taverne" , $tav_id);
}

//retourne toutes les groupes existants ou l'info d'un groupe en paritculier
// optionel : v_id -> si absent toutes les grupes sont retournes
//return array avec g_id, g_debuttravail, g_fintravail, g_taverne_fk, g_tunnel_fk

function groupe($bdd, $groupe_id=NULL)
{
    if($groupe_id=="none")
    {
        return FALSE;    
    }    
    return vaChercher($bdd , "groupe" , $groupe_id);
}

//retourne tout les tunnel existants ou l'info d'un tunnel en paritculier
// optionel : v_id -> si absent toutes les tunnel sont retournes
//return array avec t_id, t_progres, t_villedepart_fk, t_villearrivee_fk

function tunnel($bdd, $tun_id=NULL)
{
    if($tun_id=="none")
    {
        return FALSE;    
    }    
    return vaChercher($bdd , "tunnel" , $tun_id);
}

//cette function retourne le nombre de nains dans une taverne
// param d'entree : $bdd , $id_tavenre
// retourne int ou false si erreur

function combienDeNains($bdd , $taverne_id)
{
    $nains = FALSE;
    try
    {                        
        if(($resource = $bdd->prepare('SELECT g_id FROM groupe WHERE g_taverne_fk = :gid'))!==FALSE)
        {
            if($resource->bindValue('gid' , $taverne_id))
            {
                if($resource->execute())
                {
                    // execution seccesful
                    if(($groupesDansTaverne = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                    {
                        foreach($groupesDansTaverne as $gid)
                        {
                                                  
                                if(($resource = $bdd->query('SELECT n_id FROM nain WHERE n_groupe_fk = '. $gid['g_id']))!==FALSE)
                                {
                                    if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                                    {
                                       foreach($data as $item)
                                       {
                                            $nains = $nains + 1;
                                       }
                                    }
                                }
                        }
                    }
                }
            }
        }
    }
    catch(PDOException $msg)
    {
        die($msg->getMessage());
    }
    
    if($nains==FALSE)
    {
        $nains = 0;
    }
    
    
    return $nains;
}



//cette function retrourne le nb nains dans un groupe
// param dentree : $bdd, $groupe_id
// retourne un entier

function nianDansGroupe($bdd, $groupe_id)
{
    if(($resource = $bdd->prepare('SELECT COUNT(n_id) FROM nain WHERE n_groupe_fk  = :gid'))!==FALSE)
    {
        if($resource->bindValue('gid' , $groupe_id))
        {
            if($resource->execute())
            {
                if(($data = $resource->fetch())!==FALSE)
                {
                    return  $data;    
                }
            }
        }
    }
}


?>