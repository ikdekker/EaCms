<?php

namespace EaCms\Core\Patterns\Singleton;
/**
 * Description of SingletonMember
 *
 * @author Nick
 */
class SingletonMember {
    
    protected function getStatic($staticMember, $instance) {
        if (!$this->$staticMember instanceof $instance) {
            $this->$staticMember = new $instance;
        }
        return $this->$staticMember;        
    }
    
}
