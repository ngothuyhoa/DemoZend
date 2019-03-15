<?php
namespace Home\Entity;
use Doctrine\ORM\Mapping as Mapping;
//use Doctrine\Common\Collections\ArrayCollection;
//use Home\Entity\Books;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="images")
 */
class Images{
    //`id`, `url`

    /**
     * @Mapping\Id
     * @Mapping\Column(type="integer")
     * @Mapping\GeneratedValue
     */
    private $id;

    /** @Mapping\Column(type="string") */
    private $url;

    //`id`, `url`

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
    public function getUrl(){
        return $this->url;
    }

    /**
     * @param
     */
    public function setUrl($url){
        $this->url = $url;
    }

   /**
    * @Mapping\ManyToMany(targetEntity="\Home\Entity\Books", mappedBy="images")
    */
    
    protected $books;
    
    // Constructor.
    public function __construct() 
    {        
        $this->books = new ArrayCollection();        
    }
  
    // Returns posts associated with this tag.
    public function getBooks() 
    {
        return $this->Books;
    }
    
    // Adds a post into collection of posts related to this tag.
    public function addBooks($book) 
    {
        $this->books[] = $books;        

    }
    
}


?>