<?php


namespace EaCms\Core\Database\Communication;

use EaCms\Core\Patterns\Singleton\Singleton;
use PDO;
use const ROOTPATH;

class DbConnector extends Singleton {
    
    private static $link = null ;
        
    protected $db_user;
    
    protected $db_pass;
    
    public static function getLink ( ) {
        if ( self :: $link ) {
            return self :: $link ;
        }

        $ini = ROOTPATH . "config/db.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        $driver = $parse [ "db_driver" ] ;
        $dsn = "${driver}:" ;
        $user = $parse [ "db_user" ] ;
        $password = $parse [ "db_password" ] ;
        $options = $parse [ "db_options" ] ;
        $attributes = $parse [ "db_attributes" ] ;

        foreach ( $parse [ "dsn" ] as $k => $v ) {
            $dsn .= "${k}=${v};" ;
        }

        self :: $link = new PDO ( $dsn, $user, $password, $options ) ;

        foreach ( $attributes as $k => $v ) {
            self :: $link -> setAttribute ( constant ( "PDO::{$k}" )
                , constant ( "PDO::{$v}" ) ) ;
        }

        return self :: $link ;
    }
}