<main>
  <div class="groupeConatiner">
      <a href="?c=Group" class="retour"> &#8592; Groupes</a>
      <hr>
      <div>
         <h3>Groupe n&#176; <?php  echo $groupe['id']; ?></h3>
         <p>S'hydrate chez : <a href="?id=<?php echo $taverne['t_id'];?>&c=Taver"><?php  echo $taverne['t_nom']; ?></a></p>
         <hr>
         <p>Tunnel n&#176; <?php echo $tunnel['t_id'];?><br>
         <?php echo $groupe['debutH'] . " a " . $groupe['finH']?><br>
             
             (<?php echo $tunnel['t_progres'] . " %";?>)
         </p>
         <hr>
         <p>
            <span>Membres</span>
            <ul>
               <?php               
                foreach($membres as $nain)
                {
                   ?>
                   <li>
                   <a href="?id=<?php echo $nain['n_id'];?>&c=Nain"> 
                   <?php echo $nain['n_nom']; ?>
                   </a>
                   </li>                                    
                   <?php
                }
                
               ?>
            </ul>
         </p>
      </div>
  </div>
  
<style type="text/css">
 main{
  width: 80%;
  display: flex;
  flex-direction: row;
 }
  
.groupeConatiner
{  
    margin-top: 10px;
    box-sizing: border-box;
    width: 25%;
    box-sizing: border-box;
}

.groupeConatiner a.retour
{
    padding: 10px;
    background-color: #ccc;
    display: block;
    width: 100%;
    text-align: center;
    text-decoration: none;
    font-size: 1.8rem;
    color: #333;
    font-weight: bold;box-sizing: border-box;
}

.groupeConatiner div
{
    float: left;
    border-right: solid 1px #666;
    box-sizing: border-box;    
    overflow: hidden;
    width: 100%;
}

.groupeConatiner div h3
{
    margin: 0;
    padding: 10px;
    font-weight: bold;
    font-size: 2.4rem;
    color: #666;
    border-bottom: solid 1px #666;
}

.groupeConatiner div p
{
    margin: 0;
    text-align: center;
    padding: 10px;
    font-size: 1.8rem;
    color: #666;
}


.groupeConatiner div span
{
    font-weight: bold;
    color: #333;
    text-decoration: underline;
}

.groupeConatiner div ul
{
    list-style: none;
    width: 100%;
    margin: 0;
    padding: 0;
}

.groupeConatiner div ul li
{
    width: 100%;
    text-align: center;
    margin: 3px;
    font-size: 1.4rem;
    background-color: #eee;
    padding: 2px;
}

.groupeConatiner div p a
{
    color: #666;
}

.groupeConatiner div ul li a
{
    color: #666;
}


</style>