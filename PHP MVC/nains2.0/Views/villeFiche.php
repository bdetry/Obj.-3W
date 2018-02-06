<div class="villeConatiner">
    <hr>
    <a href="?c=Ville" class="retour"> &#8592; Villes</a>
    <hr>
    <div style="width: 100%; background-color: #eee; padding: 10px; font-size: 2.5rem; font-weight:bold;">
        <?php echo $nom; ?>
    </div>
    <div>
        <p>Nain d'ici</p>
        <ul>
        <?php
            foreach($nains as $nain)
            {
               ?><li><a href="?id=<?php echo $nain['n_id']; ?>&c=Nain"><?php echo $nain['n_nom']; ?></a></li><?php
            }
        ?>
        </ul>
    </div>
    <div>
        <p>Tavernes d'ici</p>
        <ul>
        <?php
            foreach($tavernes as $taverne)
            {
               ?><li><a href="?id=<?php echo $taverne['t_id']; ?>&c=Taver"><?php echo $taverne['t_nom']; ?></a></li><?php
            }
        ?>
        </ul>
    </div>
    <div>
        <p>Tunnelles partants</p>
        <ul>
        <?php
            foreach($tunnels as $tunnel)
            {
               ?><li><a href="?id=<?php echo $tunnel['v_id']; ?>&c=Ville">Tunnel <?php echo $tunnel['t_id']; ?> vers <?php echo $tunnel['v_nom']; ?></a></li><?php
            }
        ?>
        </ul>
    </div>    
</div>


<style type="text/css">
.villeConatiner
{
    width: 70%;  
    margin-top: 50px;
}

.villeConatiner a.retour
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

.villeConatiner div
{
    width: 33%;
    float: left;
    background-color: #fff;
    border-right: solid 1px #999;
}

.villeConatiner div p
{
    width: 100%;
    text-align: center;
    font-size: 1.6rem;
    color: #666;
    border-bottom: solid 1px #ddd;
    margin: 0;
    padding: 10px;
    box-sizing: border-box;
    font-weight: bold;
}


.villeConatiner ul
{
    margin: 0;
    padding: 0;
    list-style: none;
    text-align: center;
}

.villeConatiner ul li
{
    padding: 5px;
    box-sizing: border-box;
    font-size: 1.5rem;
    border-bottom: solid 1px #ddd;
}

.villeConatiner ul li a
{
    color: #999;
}
</style>