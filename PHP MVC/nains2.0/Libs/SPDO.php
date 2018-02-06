<?php

class SPDO
{
    
    private $_db;
    private static $_instance;
    
    private function __construct( $host, $dbname, $login, $pass, $charset, $collate )
    {
        try
        {
            $opt = array( PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES ' . $charset . ' COLLATE ' . $collate, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
            $this->_db = new PDO( 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=' . $charset, $login, $pass, $opt );
        }
        catch( PDOException $e )
        {
            throw $e;
        }
    }
    
    
    public static function getInstance( $host = null, $dbname = null, $login = null, $pass = null, $charset = 'utf8', $collate = 'utf8_general_ci' )
    {
        try
        {
            if( !isset( self::$_instance ) )
                self::$_instance = new SPDO( $host, $dbname, $login, $pass, $charset, $collate );
                
            return self::$_instance;        
        }
        catch( Exception $e )
        {
            throw $e;
        }
    }
    
    public function getPDO()
    {
        return $this->_db;
    }
}