<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EaCms\Core\Database\Users;

use EaCms\Core\Database\Query\Query;
use EaCms\Core\Factory\CoreFactory;
use EaCms\Core\User\User;
use PDOException;

class UserQuery extends Query {
    
    static public function add(User $user) {
        try {
            $fact = CoreFactory::getInstance();
            $dbCon = $fact->get('db-connector');
            $link = $dbCon->getLink();
            
            $stmt = $link->prepare(
                "SELECT username, UID from ea_users" // update statement to include user and UID to check for dupes
            );
            
            $stmt->execute();
            
            $res = $stmt->fetch();
            
            var_dump($res);
            $stmt = $link->prepare(
                "insert into ea_users set
                username = :username,
                password = :password,
                screen_name = :screen_name,
                UID = :UID"
            );

            $stmt->execute([
                ':username' => $user->getUsername(),
                ':password' => $user->getPasswordHash(),
                ':screen_name' => $user->getScreenName(),
                ':UID' => $user->getUID()
            ]);
        } catch (PDOException $e) {
            //handleSqlException();
            var_dump($e->errorInfo[2]);
            echo 'Connection failed: ' . $e->getMessage();
            switch ($e->errorInfo[1]) {
                case '1062':
                    
                    break;

                default:
                    break;
            }
        }
        $stmt->closeCursor();
    }
    
    public function handleAddException() {
        
    }

}
