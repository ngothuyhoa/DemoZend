<?php
namespace Home\Service;
use Home\Entity\Books;

class BookManager{

    private $entityManager;
    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }

    public function All() {
    	//return $this->entityManager->getRepository(Books::class)->findAll();
    	
    }

}