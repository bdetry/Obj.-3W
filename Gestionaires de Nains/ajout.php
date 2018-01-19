<p>Ajouter utilisateur.</p>
            
            <div>
                <form method="post" action="?newUser&add">
                    <input type="text" name="newMail" placeholder="New user email">
                    <input type="password" name="newPass" placeholder="New user password">
                    <select name="newRole">
                        <option value="none" selected> </option>
                        
                    <?php                    
                    try
                    {                        
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
                    }
                    catch(PDOException $msg)
                    {
                        die($msg->getMessage());
                    }                    
                    ?>
                    </select>
                    <input type="submit" value="Cree" style="background-color: #aaa;">
                </form>
            </div>
            <?php
            
            // traitement add
            $error = FALSE;
            $good = FALSE;
            if(isset($_GET['newUser']))
            {
                if(isset($_POST['newMail']) AND isset($_POST['newPass']) AND isset($_POST['newRole']))
                {
                    if($_POST['newMail']!="" AND $_POST['newPass']!="" AND $_POST['newRole']!="none")
                    {
                        if(filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL)==TRUE)
                        {
                            try
                            {
                                if(($resourceVerifMail = $bdd->prepare('SELECT user_id FROM user WHERE user_mail = :mailVerif ;'))!==FALSE)
                                {
                                     if(($resourceVerifMail->bindValue('mailVerif', $_POST['newMail']))!==FALSE)
                                     {
                                        if($resourceVerifMail->execute())
                                        {                                                                                
                                            if(($returnVeirfMail = $resourceVerifMail->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                                            {
                                                if(empty($returnVeirfMail))
                                                {  
                                                    if(($resourceInsert = $bdd->prepare('INSERT INTO user(user_mail, user_pass, role_id) VALUES(:user_mail, :user_pass, :role_id)'))!==FALSE)
                                                     {
                                                         if($resourceInsert->bindValue('user_mail' , $_POST['newMail']) AND $resourceInsert->bindValue('user_pass' , $_POST['newPass']) AND $resourceInsert->bindValue('role_id' , $_POST['newRole']))
                                                         {
                                                             if($resourceInsert->execute())
                                                             {
                                                                 $good = TRUE;
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
                                                    $error = "L'email est deja utilise";
                                                }
                                            }
                                            else
                                            {
                                                echo "Erreur query(); mail verif";
                                            }
                                        }
                                        else
                                        {
                                            echo "Erreur execute(); mail verif";
                                        }
                                    }
                                    else
                                    {
                                        echo "Erreur fetchAll(); mail verif";
                                    }                                    
                                }
                                else
                                {
                                    echo "Erreur prepare(); mail verif";
                                }
                            }
                            catch(PDOException $msg)
                            {
                                die($msg -> getMessage());
                            }
                        }
                        else
                        {
                            $error = "L'addresse mail fournie est incorrecte";
                        }
                    }
                    else
                    {
                        $error = "Un ou plusierus champs du formulaire sont vides";
                    }
                }
            }
            
            if($error!=FALSE)
            {
                ?><p style="color: red; font-size: 1.5rem"><?php echo $error; ?></p><?php
            }
            
            if($good==TRUE)
            {
                ?><p style="color: green; font-size: 1.7rem">L'utilisateur a ete cree avec succes!</p><?php
            }
            