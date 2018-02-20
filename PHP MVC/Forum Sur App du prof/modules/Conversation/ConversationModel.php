<?php


class ConversationModel extends KernelModel {
    
    public function get($id=null)
    {
         if( !empty( $id ) ) :
            $query = 'SELECT * FROM conversation WHERE c_id = :id';

            return $this->query(
                $query,
                array(
                    'id'    => array(
                        'VAL'   => $id,
                        'TYPE'  => PDO::PARAM_INT
                    )
                )
            );

        else:
            $query = 'SELECT * FROM conversation';

            return $this->query(
                $query,
                array(),
                array(
                    self::ATTR_RETURNMODE   => self::RETURNMODE_FETCHALL
                )
            );
        endif;
    }
    
    public function MsgOfConv($id)
    {
        $query = 'SELECT * FROM message WHERE m_conversation_fk  = :id';

            return $this->query(
                $query,
                array(
                    'id'    => array(
                        'VAL'   => $id,
                        'TYPE'  => PDO::PARAM_INT
                    )
                )
            );
        return false;
    }
    
    public function AuthOfMsg($u_id)
    {
        $query = 'SELECT u_prenom FROM user WHERE u_id  = :u_id';

            return $this->query(
                $query,
                array(
                    'u_id'    => array(
                        'VAL'   => $u_id,
                        'TYPE'  => PDO::PARAM_INT
                    )
                )
            );
        return false;
    }
}