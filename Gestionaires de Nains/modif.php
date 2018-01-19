<p>Modifier utilisateur.</p>
<?php


if(isset($_GET['selected']))
{
            if(isset($_POST['userModif']))
            {         
                        if(($resourceUser = $bdd->prepare('SELECT * FROM user WHERE user_id = :id'))!==FALSE)
                        {
                            if($resourceUser->bindValue('id' , $_POST['userModif']))
                            {
                                if($resourceUser->execute())
                                {                                    
                                     if(($usrData = $resourceUser->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                                     {
                                                ?>
                                                <p><?php echo $usrData[0]['user_id'] ; ?></p>
                                                <form method="post" action="?modif&modified" >
                                                 <input type="text" name="email" value="<?php echo $usrData[0]['user_mail'] ; ?>" style="background-color: #999;">
                                                 <input type="password" name="pass" value="<?php echo $usrData[0]['user_pass'] ; ?>" style="background-color: #999;">
                                                 <select name="role" style="background-color: #999;">
                                                 <?php
                                                            if(($resourceRole = $bdd->query('SELECT * FROM role'))!==FALSE)
                                                            {
                                                                if(($dataRole = $resourceRole->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                                                                {
                                                                   foreach($dataRole as $role)
                                                                   {
                                                                        ?><option value="<?php echo  $role['role_id'];?>"><?php echo  $role['role_libelle'];?></option><?php
                                                                   }
                                                                }
                                                                else
                                                                {
                                                                    echo  "Erreur fetachAll()";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo  "Erreur query()";
                                                            }
                                                 
                                                ?>
                                                </select>
                                                 
                                                 <input type="hidden" name="id" value="<?php echo $usrData[0]['user_id'] ; ?>">
                                                 <input type="submit" value="Modifer" style="background-color: #666;">
                                                </form>
                                                <?php        
                                     }
                                     else
                                     {
                                                echo "Erreur fetchall();";
                                     }                                   
                                }
                                else
                                {
                                    echo "Erreur execute();";
                                }
                            }
                            else
                            {
                                  echo "Erreur bindValue();";
                            }
                        }
                        else
                        {
                             echo "Erreur prepare();";
                        }
            } 
}
else
{
      ?>
      <div style="font-size: 1.8rem; padding: 5px;">Selectionez un utilisateur a modifier.</div>
      <form action="?selected&modif" method="post">
            <select name="userModif" value="" style="background-color: #999; padding: 10px;" selected>
            <?php
            try
            {                        
                if(($resourceUsers = $bdd->query('SELECT * FROM user'))!==FALSE)
                {
                    if(($dataUsers = $resourceUsers->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                    {
                       foreach($dataUsers as $item)
                       {
                             ?><option value="<?php echo $item['user_id']; ?>"> <?php echo $item['user_id']; ?> - <?php echo $item['user_mail']; ?></option><?php
                       }
                    }
                    else
                    {
                        echo "error fetch";
                    }
                }
                else
                {
                    echo "error query";
                }
            }
            catch(PDOException $msg)
            {
                die($msg->getMessage());
            }
            
            ?>
            </select>
            <input type="submit" value="Modifier" style="background-color: #999; padding: 10px;">            
      </form>
            
      <?php
      
      if(isset($_GET['modified']))
      {
            if(isset($_POST['email']) AND isset($_POST['pass']) AND isset($_POST['role']) AND isset($_POST['id']))
            {
                        if(($resource = $bdd->prepare('UPDATE user SET user_mail = :email , user_pass = :pass , role_id = :role WHERE user_id = :id'))!==FALSE)
                        {
                            if($resource->bindValue('email' , $_POST['email']) AND $resource->bindValue('pass' , $_POST['pass']) AND $resource->bindValue('role' , $_POST['role']) AND $resource->bindValue('id' , $_POST['id']))
                            {
                                if($resource->execute())
                                {
                                    ?><p style='color: green; padding:0; margin:0; font-size:1.3rem;'>Utilisateur correctement modifie</p><?php
                                }
                                else
                                {
                                     echo "Erreur execute();";
                                }
                            }
                            else
                            {
                                 echo "Erreur bindValue();";
                            }
                        }
                        else
                        {
                            echo "Erreur prepare();";
                        } 
            }
            else
            {
                        echo "ereur transmiosion des donnees";
            }
      }
      
}

?>