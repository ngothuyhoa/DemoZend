<?php
namespace Login\Service;
use Login\Entity\Users;
use Zend\Crypt\Password\Bcrypt;

class UserManager{

    private $entityManager;
    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }

    public function checkEmailExists($email){
        $user = $this->entityManager->getRepository(Users::class)->findOneByEmail($email);
        // if($user!==null) return true;
        // return false;
        return $user !== null;
    }

    public function checkUsernameExists($username){
        $user = $this->entityManager->getRepository(Users::class)->findOneByUsername($username);
        return $user !== null;
    }

    public function addUser($data){
        if($this->checkEmailExists($data['email'])){
            throw new \Exception("Email ".$data['email']." đã có người sử dụng");
        }
        if($this->checkUsernameExists($data['username'])){
            throw new \Exception("Username ".$data['username']." đã có người sử dụng");
        }
         //`id`, `username`, `password`,
        // `fullname`, `birthdate`, `gender`, `address`, `email`, `phone`, `role`
        $user = new Users;
        $user->setUsername($data['username']);      
        $user->setEmail($data['email']);
        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($data['password']);
        $user->setPassword($securePass);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;

        //111111!!
    }

    public function validatePassword($user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        
        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }
        
        return false;
    }
}