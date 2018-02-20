<style type="text/css">
    @charset "UTF-8";

html
{
    font-size: 62.5%;
}

body
{
    margin: 0;
    background-color: #ddd;
}

h4
{
    margin-left: 10vw;
    padding: 5px;
    color: #666;
}

table
{
    width: 500px;
    text-align: center;
    border-collapse: collapse;
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: 10vw;
}

table td
{
    padding: 5px;
    font-size: 1.9rem;
    border: solid 1px #333;
    
}

.open
{
    background-color: #8fea90;
}

.closed
{
    background-color: #ea8f8f;
}

a
{
    color: #333;
    text-decoration: none;
}

</style>

<?php
    if(SRequest::getInstance()->get('p')==NULL)
    {
        $next = 1;
        $prev = 0;
    }
    else
    {
         $next = SRequest::getInstance()->get('p') + 1;
        $prev = $next - 2;
    }
    
    if($next<0 OR $prev<0)
    {
        $next = 1;
        $prev = 0;
    }
    
    if(!is_null(SRequest::getInstance()->get('p')))
    {
        $p = SRequest::getInstance()->get('p');
    }
    else
    {
        $p = 0;
    }
?>

<table>
    <tr>
        <td><a href="./conversation?id=<?php echo SRequest::getInstance()->get('id') . "&p=" . $p . "&By=id"?>">By ID</a></td>
        <td><a href="./conversation?id=<?php echo SRequest::getInstance()->get('id') . "&p=" . $p . "&By=date"?>">By Date</a></td>
        <td><a href="./conversation?id=<?php echo SRequest::getInstance()->get('id') . "&p=" . $p . "&By=auth"?>">By Auth</a></td>
    </tr>
</table>

<table>
    <tr>
        <td><a href="./conversation?id=<?php echo SRequest::getInstance()->get('id') . "&p=" . $prev?>">&larr;</a></td>
        <td><a href="./conversation?id=<?php echo SRequest::getInstance()->get('id') . "&p=" . $next?>">&rarr;</a></td>
    </tr>
</table>

<?php

$convs_msg = $this->getClass()[""]->getCmsg();

            if(!is_null($convs_msg) AND !empty($convs_msg))
            {
                echo "<table>";
                echo "<tr>
                <td><strong>DATE</strong></td>
                <td><strong>HEURE</strong></td>
                <td><strong>Nom</strong></td>
                <td><strong>Cont.</strong></td>
                </tr>";
                foreach($convs_msg as $key => $msg)
                {
                    if(!is_null($msg))
                    {
                     echo '<tr>
                        <td>'.$msg->getDate().' <br> ID : '.$msg->getId().'</td>
                        <td>'.$msg->getHeure().'</td>
                        <td> '.$msg->getNomPren()['u_prenom'].'</td>
                        <td>'.$msg->getMsg().'</td>
                        </tr>
                        ';    
                    }
                    else{
                        echo "<tr><td colspan='4'>Fin de Conv</td></tr>";
                        break;
                    }
                }
                echo "</table>";
            }
            else
            {
                ?><script type="text/javascript">
                    window.location.href = "?404";
                </script><?php
            }
