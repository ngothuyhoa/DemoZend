<?php
namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Home\Entity\Books;
use Home\Entity\Images;

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

        
        /*$book = $this->entityManager->createQueryBuilder();
        $book
            ->select('b', 'i')
            ->from('Home\Entity\Books', 'b')
            ->leftJoin(
                    'Home\Entity\Images', 'i', \Doctrine\ORM\Query\Expr\Join::WITH, 'b.cityId = c.cityId'
            )
            ->where('uc = :cityId')
            ->setParameter('cityId', $cityId);
    		return $qb->getQuery()->getResult();*/
    	foreach ($books as $book) {
    		/*foreach ($book->getCategories() as $cate) {
    			echo "<pre>";
		        var_dump($cate);
		        echo "</pre>";
    		}*/

    		echo "<pre>";
		        var_dump(((array)$book->getCategories())[1]);
		        echo "</pre>";
    			

    	}
        
    	return false;
        
       
        /*$view = new ViewModel(['books' => $books]);
        
        return $view;*/
    }
}
