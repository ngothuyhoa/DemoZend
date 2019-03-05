<?php
namespace Login\Entity;
use Doctrine\ORM\Mapping as Mapping;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="users")
 */
class Users{
    //`id`, `user_name`, `password`, `email`

    /**
     * @Mapping\Id
     * @Mapping\Column(type="integer")
     * @Mapping\GeneratedValue
     */
    private $id;

    /** @Mapping\Column(type="string") */
    private $username;

    /** @Mapping\Column(type="string") */
    private $password;

    /** @Mapping\Column(type="string", name="email", unique=TRUE) */
    private $email;


    //`id`, `user_name`, `password`, `email`
    
    /**
     * @return
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @param
     */
    public function setEmail($email){
        $this->email = $email;
    }
    
    /**
     * @return
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @param
     */
    public function setPassword($password){
        $this->password = $password;
    }
    /**
     * @return
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @param
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @return
     */
    public function getUsername(){
        return $this->username;
    }

    /**
     * @param
     */
    public function setUsername($username){
        $this->username = $username;
    }
}


?>