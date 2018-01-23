<div class="nainProfile">
    <a href="nain.php" class="retour"> &#8592; Nains</a>
    <hr>
    
    <?php
    
    if($nain[0]['n_groupe_fk']==NULL)
    {
        $nain[0]['n_groupe_fk']="none";
    }
    $groupe = groupe($bdd, $nain[0]['n_groupe_fk']);
    $villeConcerne=ville($bdd, $nain[0]['n_ville_fk']);
    $taverneConcerne=taverne($bdd, $groupe[0]['g_taverne_fk']);
    $tunnelConcerne = tunnel($bdd, $groupe[0]['g_tunnel_fk']);
    ?>
    
    <div>
        <table>
            <tr>
                <td style="font-weight: bold;"><?php echo $nain[0]['n_nom'];?></td>
                <td style="font-weight: light; font-size: 1.2rem;">(Barbe : <?php echo $nain[0]['n_barbe'];?> cm)</td>
            </tr>
            <tr>
                <td style="font-size:1.5rem;">Origine : </td>
                <td><a href="ville.php?vid=<?php echo $villeConcerne[0]['v_id']; ?>" style="text-decoration: underline; color: #333;"><?php echo ($villeConcerne[0]['v_nom']); ?></a></td>
            </tr>
            <tr>
                <td style="font-size:1.5rem;">Hydratation : </td>
                <td><a href="taverne.php?tid=<?php echo $taverneConcerne[0]['t_id']; ?>" style="text-decoration: underline; color: #333;"><?php                
                if($groupe[0]['g_id']!=NULL)
                {
                    echo ($taverneConcerne[0]['t_nom']);
                }
                ?></a></td>
            </tr>
            <tr>
                <td style="font-size:1.5rem;">Groupe ID : </td>
                <td><a href="groupe.php?gid=<?php echo $groupe[0]['g_id']; ?>" style="text-decoration: underline; color: #333;">
                <?php echo $groupe[0]['g_id']; ?></a></td>
            </tr>
            <tr>
                <td style="font-size:1.5rem;">Actuelement : </td>
                <td style="font-size: 1.6rem;">
                    
                    <?php
                        if($groupe[0]['g_id']!=NULL)
                        {
                           ?>
                           Tunnel :  <?php echo $groupe[0]['g_tunnel_fk']; ?> <br>
                            De <?php echo  $groupe[0]['g_debuttravail'] . " a " .$groupe[0]['g_fintravail'];?><br>
                            <a style="text-decoration: underline; color: #333;" href="ville.php?vid=<?php echo ville($bdd, $tunnelConcerne[0]['t_villedepart_fk'])[0]['v_id']; ?>">
                            <?php echo ville($bdd, $tunnelConcerne[0]['t_villedepart_fk'])[0]['v_nom']; ?>
                            </a>
                            --
                            <a style="text-decoration: underline; color: #333;" href="ville.php?vid=<?php echo ville($bdd, $tunnelConcerne[0]['t_villearrivee_fk'])[0]['v_id']; ?>">
                            <?php echo ville($bdd, $tunnelConcerne[0]['t_villearrivee_fk'])[0]['v_nom']; ?>
                            </a>
                           <?php
                        }
                    ?>

                
                </td>
            </tr>
        </table>
    </div>
    
    <div>
        <h3>Assigner groupe en NAIN click</h3>
        <form action="?nid=<?php echo $_GET['nid']; ?>" method="post">
            <select name="ngid">
                <?php
                
                foreach(groupe($bdd) as $groupe)
                {
                    ?><option value="<?php echo $groupe['g_id']; ?>">Groupe <?php echo $groupe['g_id'] ?></option><?php
                }
                
                ?>
                <option value="vacc">Envoyer en vaccances</option>
            </select>
            <input type="submit" value="Changer de groupe">
        </form>
    </div>

    
</div>