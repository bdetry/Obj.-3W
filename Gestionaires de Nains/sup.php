          <p>Supprimer utilisateur.</p>
            <div class="supForm">
                <form method="post" action="?sup&supsent">
            <?php
            try
            {
                if(($resourceSup = $bdd->query('SELECT * FROM user'))!==FALSE)
                {
                    if(($dataSup = $resourceSup->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                    {
                       foreach($dataSup as $element)
                       {
                            ?><div style="display: block; "><input name="toSup[]" type="checkbox" value="<?php echo  $element['user_id'];?>"><span style="vertical-align: top; font-size: 1.9rem;"><?php echo  $element['user_mail']; ?></span></div><?php
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
                die($msg -> getMessage());
            }       
            ?>
            <input type="submit" value="Suprimer directement" style="background-color: #d36969; color: #333; width: 100%; height: 60px;">
            </form>
            </div>
            <?php
            
            //traitement sup ............................
            
            if(isset($_POST['toSup']))
            {
               foreach($_POST['toSup'] as $element)
               {
                  $element = intval($element);
                     if(($resDel = $bdd->prepare('DELETE FROM user WHERE user_id = :userID'))!==FALSE)
                     {
                        if($resDel -> bindValue('userID' , $element))
                        {
                           if($resDel -> execute())
                           {
                              echo "<p style='color: green; padding:0; margin:0; font-size:1.3rem;'>User ".$element." a ete suprime</p>";
                           }
                           else
                           {
                              echo "error execute for:" . $element;
                           }
                        }
                        else
                        {
                           echo  "error bind for:" . $element;
                        }
                     }
                     else
                     {
                        echo  "error prepare for:" . $element;
                     }
                  
               }
            }