<head>
    <link rel="icon" href="medias/favicon.ico" type="image/x-icon">
</head>
<?php
require_once("./Libs/config.php");

    $page;
    if(isset($_GET['c']))
    {
        $class = $_GET['c'] . "Control";
    }
    else
    {
        $class = "HomeControl";
    }
    
    $classModal;
    if(isset($_GET['c']))
    {
        $classModal = $_GET['c'] . "Model";
    }
    else
    {
        $classModal = "HomeModel";
    }
    
    
    if(file_exists("./Control/".$class.".php"))
    {
        require_once("./Libs/SPDO.php");
        $pdo = SPDO::getInstance(DB_HOST, DB_NAME , DB_USER , DB_PASS)->getPDO(); // controleur 
        require_once("./Control/".$class.".php");
        
        if(file_exists("./Model/".$classModal.".php")) // Modal si il en existe 
        {
            require_once("./Model/".$classModal.".php");
        }
       
        
        $class = new $class();
        $class->showHeader();
        
        $whichOne = null;
        if(isset($_GET['id']))
        {
            $whichOne = $_GET['id'];
        }
        
        if($class->showMain( $pdo,  $whichOne )!=false)
        {
            if(isset($_GET['do']))
            {
                $method = $_GET['do'] . "Act";
            }
            else
            {
                $method = NULL;
            }
            
            if($method!=NULL)
            {
                if(method_exists($class , $method))
                {
                    if(isset($_POST['ngid']))
                    {
                       if($class->$method($_GET['id'] , $_POST['ngid']))
                       {
                           echo ' redirection js .... ';
                            ?>
                            <script type="text/javascript">
                                window.location.href = document.URL;
                            </script>
                            <?php
                       }
                       else
                       {
                            echo "Erreur";
                       }
                    }
                    elseif(isset($_POST['heureDebut']))
                    {
                        if($class->$method($_GET['id'] , $_POST['heureDebut'], $_POST['heureFin']))
                       {
                           echo "<span class='mesg'>Horaires Changes</span>";
                       }
                       else
                       {
                            echo "Erreur";
                       }
                    }
                    elseif(isset($_POST['newTunnel']))
                    {
                       if($class->$method($_GET['id'] , $_POST['newTunnel']))
                       {
                           echo "<span class='mesg'>Tunnel Change</span>";
                       }
                       else
                       {
                            echo "Erreur";
                       }
                    }
                    elseif(isset($_POST['newTaverne']))
                    {
                        if($class->$method($_GET['id'] , $_POST['newTaverne']))
                       {
                           echo "<span class='mesg'>Taverne Change</span>";
                       }
                       else
                       {
                            echo "Erreur";
                       }
                    }
                }
            }
        }
        else
        {
            header('Location: 404');
        }
    }
    else
    {
        header('Location: 404');
    }
    
    
    ?>
    
    
    <style type="text/css">
            .mesg
    {
        font-size: 2rem;
        color: green;
        background-color: #eee;
        width: 200px;
        text-align: center;
        padding: 10px;
    }
    </style>