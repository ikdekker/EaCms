<?php

namespace EaCms\Core\User;

use EaCms\Core\Database\Users\UserQuery;


/**
 * Object for representing users, and manipulating their data
 */
class User {
    
    const USER_TYPE_ADMIN = "0";

    /**
     * UID for the user
     * @var string
     */
    public $UID;
    
    /**
     * @var string
     */
    public $username;
    
    /**
     * @var string
     */
    public $email;
    
    /**
     * User's name as shown on posts
     * @var string
     */
    public $screenName;
    
    /**
     * The bcrypted password string
     * @var string
     */
    public $passwordHash;
    
    /**
     * Timestamp of user creation
     * @var int
     */
    public $registerDate;
    
    /**
     * Type of account
     * @var int
     */
    public $rights;
    
    public function __construct($username, $passwordHash, $screenName = null) {
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->setScreenName($screenName
                           ? $screenName
                           : $username);
        $this->generateUID();
    }
    
    public function generateUID() {
        $this->UID = uniqid();
        return $this->UID;
    }
    
    public function save() {
        //@todo make userquery into factory singleton
        $added = UserQuery::add($this);
        
    }
    
    public function getUID() {
        return $this->UID;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getScreenName() {
        return $this->screenName;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function getRegisterDate() {
        return $this->registerDate;
    }

    public function getRights() {
        return $this->rights;
    }

    public function setUID($UID) {
        $this->UID = $UID;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setScreenName($screenName) {
        $this->screenName = $screenName;
        return $this;
    }

    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
        return $this;
    }

    public function setRegisterDate($registerDate) {
        $this->registerDate = $registerDate;
        return $this;
    }

    public function setRights($rights) {
        $this->rights = $rights;
        return $this;
    }
}