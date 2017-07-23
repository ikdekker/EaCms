<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EaCms\Core\Patterns\Singleton;

use EaCms\Core\Exception\NotImplementedException;

/**
 * Description of Singleton
 *
 * @author Nick
 */
abstract class Singleton implements SingletonInterface{

    private function __construct() {}
    
    private function __clone() {}
    
    private function __wakeup() {}
    
    static protected function me() { throw new NotImplementedException("Please implement me in: " . __FILE__); }
    
    static public function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }
}
