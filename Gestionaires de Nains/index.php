<?php
 session_start();
 
 
    $error = NULL;
    if(isset($_POST['mail']) AND isset($_POST['pass']))
    {
        if($_POST['mail']!="" AND $_POST['pass']!="")
        {
            if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)==TRUE)
            {
                try
                {
                    $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de données
                                    
                    $bdd= new PDO ('mysql:host=localhost;dbname=espacemembre','root', '' , $pdo_option);
                    
                    if(($connectInfo = $bdd->prepare('SELECT user_id, user_pass, role_id FROM user
                                                     WHERE user_mail = :mail'))!==FALSE)
                    {
                        if($connectInfo->bindValue('mail',$_POST['mail']))
                        {
                            if($connectInfo->execute())
                            {
                                if(($connectData = $connectInfo->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                                {
                                    if(!empty($connectData))
                                    {
                                        if($connectData[0]['user_pass']==$_POST['pass'])
                                        {
                                            $_SESSION['user'] = array(
                                                                    "user_mail" => $_POST['mail'],
                                                                    "user_id" => $connectData['user_id'],
                                                                    "role_id" => $connectData['role_id']
                                                                      );
                                            
                                            header('Location: home.php');
                                            exit;
                                        }
                                        else
                                        {
                                            $error = "Faux password";
                                        }
                                    }
                                    else
                                    {
                                        $error = "L'email n'existe pas";
                                    }
                                }
                                else
                                {
                                    echo "Erreur fetchAll();";
                                }                               
                            }
                            else
                            {
                                echo "Erreur execute();";
                            }
                        }
                        else
                        {
                            echo "Erreur blindValue();";     
                        }                      
                    }
                    else
                    {
                        echo "Erreur prepare();";                       
                    }
                    
                    $connectInfo-> closeCursor();
                }
                catch(PDOException $msg)
                {
                    die($msg -> getMessage());
                }
            }
            else
            {
                $error = "L'email fourni n'est pas un email valide";
            }
        }
        else
        {
            $error = "L'un des champs est vide";
        }
    }
 
?>

<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>ESPACE CONNECT</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>

    <p>
        Pour proceder veuillez remplir le formulaire.
    </p>
    
    <form action="" method="post">
        <input type="text" name="mail" placeholder="Email">
        <input type="password" name="pass" placeholder="Password">
        <input type="submit" value="Go !">
    </form>
    
    <?php
    
    if($error!=NULL)
    {
        echo "<p style='background-color:red;'>".$error."</p>";
    }
    
    ?>
    
    <style>
        @charset "UTF-8";

        html
        {
            font-size: 62.5%;
        }
        
        body
        {
            margin: 0;
        }
        
        p
        {
            width: 300px;
            margin: auto;
            font-size: 2rem;
            text-align: center;
            padding: 10px;
            background-color: #ccc;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        
        input
        {
            display: block;
            margin: auto;
            margin-top: 5px;
            padding: 5px;
            background-color: #eee;
            border: none;
            border-radius:5px;
        }
    </style>
</body>
</html>
