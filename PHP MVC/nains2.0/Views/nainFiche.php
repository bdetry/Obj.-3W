<div class="nainProfile">
    <hr>
    <a href="?c=Nain" class="retour"> &#8592; Nains</a>
    <hr>
<table>
    <tr>
        <td style="font-weight: bold;"><?php echo $nom;?></td>
        <td style="font-weight: light; font-size: 1.2rem;">(Barbe : <?php echo $barbe;?> cm)</td>
    </tr>
    <tr>
        <td style="font-size:1.5rem;">Origine : </td>
        <td><a href="?id=<?php echo $origine['v_id']; ?>&c=Ville" style="text-decoration: underline; color: #333;"><?php echo $origine['v_nom']; ?></a></td>
    </tr>
    <tr>
        <td style="font-size:1.5rem;">Hydratation : </td>
        <td><a href="?id=<?php echo $hydratation['t_id']; ?>&c=Taver" style="text-decoration: underline; color: #333;"><?php                
        if( $hydratation['t_id']!=NULL)
        {
            echo ( $hydratation['t_nom']);
        }
        ?></a></td>
    </tr>
    <tr>
        <td style="font-size:1.5rem;">Groupe ID : </td>
        <td><a href="?id=<?php echo $groupe['g_id']; ?>&c=Group" style="text-decoration: underline; color: #333;">
        <?php echo $groupe['g_id']; ?></a></td>
    </tr>
    <tr>
        <td style="font-size:1.5rem;">Actuelement : </td>
        <td style="font-size: 1.6rem;">
            
        <?php
                if($groupe['g_id']!=NULL)
                {
                   ?>
                   Tunnel :  <?php echo $groupe['g_tunnel_fk']; ?> <br>
                    De <?php echo  $groupe['g_debuttravail'] . " a " .$groupe['g_fintravail'];?><br>
                    <a style="text-decoration: underline; color: #333;" href="?id=<?php echo $villeDep[0]; ?>&c=Ville">
                    <?php echo  $villeDep[1]; ?>
                    </a>
                    --
                    <a style="text-decoration: underline; color: #333;" href="?id=<?php echo $villeArrv[0]; ?>&c=Ville">
                    <?php echo $villeArrv[1]; ?>
                    </a>
                   <?php
                }
            ?>
        
        </td>
    </tr>
</table>
</div>

<style type="text/css">
    
    .nainProfile 
    {
        width: 40%;
        padding-top: 50PX;
    }
    
    .nainProfile a.retour
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
    
    .nainProfile table
    {
        width: 100%;
        border-collapse: collapse;
    }
    
    .nainProfile table td
    {
        border: solid 1px #ccc;
        padding: 5px;
        background-color: #fff;
    }
</style>