<?php


class Display {
    
    private $convs;
    private $convsInstran;
    
    public function __construct()
    {
        
    }
    
    public function setConvs($convs)
    {
        $this->convs = $convs;
    }
    
    public function setConvsInstrans()
    {
       foreach($this->convs as $conv)
       {
            $convID = $conv['c_id'];
            $this->convsInsta[] = new ConversationModal($convID);
       }
    }
    
    public function getConvs()
    {
       return $this->convs;
    }
    
    public function getConvsInsta()
    {
       return $this->convsInsta;
    }
    
    public function __toString()
    {        
        $i=0;
        $retunr = '
            <table>
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>DATE</strong></td>
                <td><strong>HEURE</strong></td>
                <td><strong>Nb MSG</strong></td>
                <td><strong>Liens</strong></td>
            </tr>
        ';
        
        foreach($this->getConvsInsta() as $conv)
        {
            $retunr .= '<tr>';
            $retunr .= $conv->getConv();
            $retunr .= '</tr>';
        }
        
       $retunr .= '
            </table>    
        ';
        
        return $retunr;
    }
    
    
}