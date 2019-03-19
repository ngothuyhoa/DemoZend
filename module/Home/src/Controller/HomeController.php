<?php
namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Home\Entity\Books;
use Home\Entity\Images;
use Doctrine\ORM\Query\Expr\Join;

class HomeController extends AbstractActionController
{
    private $entityManager;
    private $bookManager;

    public function __construct($entityManager, $bookManager){
        $this->entityManager = $entityManager;
        $this->bookManager = $bookManager;
    }

    public function indexAction(){
    	
        $books = $this->entityManager->getRepository(Books::class)->findAll();
        $cateories = $this->entityManager->getRepository(Books::class)->findBy(['category_id' => '1']);

    		/*echo "<pre>";
		    var_dump($books);
		    echo "</pre>";
        return false;*/
       
        $view = new ViewModel(['books' => $books, 'cateories' => $cateories]);
        
        return $view;
    }

    public function detailAction(){

        $id = $this->params()->fromRoute('id');
        $book = $this->entityManager->getRepository(Books::class)->find($id);
        
        return new ViewModel(['book' => $book]);
    }
}
