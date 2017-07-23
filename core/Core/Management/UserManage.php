<?php

namespace EaCms\Core\Management;

use EaCms\Core\Patterns\Singleton\SingletonMember;
use EaCms\Core\User\User;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserManage extends SingletonMember {
    
    protected $bCrypter;


    public function addUser($username, $password) {
        $crypter = $this->getBcrypter();
        
        $passHash = $crypter->create($password);
        
        $user = new User($username, $passHash);
        
        $user->save();
        
        return $user;
    }
    
    protected function getBcrypter() {
        return $this->getStatic("bCrypter", "Zend\Crypt\Password\BcryptSha");
    }
    
}