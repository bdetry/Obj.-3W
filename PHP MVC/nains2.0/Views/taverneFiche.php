<div class="TaverneConatiner">
            <a href="?c=Taver" class="retour"> &#8592; Tavernes</a>
            <hr>
            <h4><?php echo $nom;?></h4>
            <p>a <a style="color: #666;" href="?id=<?php echo $ville[0]['v_id']; ?>&c=Ville"><?php echo $ville[0]['v_nom']; ?></a></p>
            <p>
               <span style="font-weight: bold; text-decoration: underline;">Bieres:<br></span>
               <?php
               
               foreach($bieres as $key => $biere)
               {
                    if($biere==1)
                    {
                        echo $key . "<br>";
                    }
               }
               
               ?>
            </p>
            <p> <?php echo $nbNains; ?> / <?php echo $chambres; ?> chambres</p>
</div>

<style type="text/css">
    .TaverneConatiner
{
    width: 30%;
    border: solid 1px #999;    
    margin-top: 10px;
    overflow: hidden;
}

.TaverneConatiner a.retour
{
    padding: 10px;
    background-color: #ccc;
    display: block;
    width: 100px;
    text-align: center;
    text-decoration: none;
    font-size: 1.8rem;
    color: #333;
    font-weight: bold;
}

.TaverneConatiner h4
{
    padding: 0;
    margin: 0;
    width: 100%;
    text-align: center;
    font-size: 2.2rem;
    color: #666;
    border-bottom: solid 1px #666;
    padding-bottom: 5px;
}

.TaverneConatiner p
{
    width: 100%;
    padding: 5px;
    text-align: center;
    background-color: #eee;
    font-size: 1.8rem;
    color: #666;
}
</style>