<?php
namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function indexAction()
    {
       // var_dump($this->postRepository->findAllPosts());
        return new ViewModel([
            'posts' => $this->postRepository->findAllPosts(),
        ]);
        
    }
    public function detailAction()
    {
       
        $id = $this->params()->fromRoute('id');
        $a = $this->postRepository->findPost($id);
        var_dump($id);
        return false;
        
    }
}