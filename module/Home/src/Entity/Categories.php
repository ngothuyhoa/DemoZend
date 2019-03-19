<?php
namespace Home\Entity;
use Doctrine\ORM\Mapping as Mapping;
use Doctrine\Common\Collections\ArrayCollection;
//use Home\Entity\Books;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="categories")
 */
class Categories{
    //`id`, `title`, `slug`

    /**
     * @Mapping\Id
     * @Mapping\Column(type="integer")
     * @Mapping\GeneratedValue
     */
    private $id;

    /** @Mapping\Column(type="string") */
    private $title;

     /** @Mapping\Column(type="string") */
    private $slug;

    //`id`, `title`, `slug`

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
    public function getTitle(){
        return $this->title;
    }

    /**
     * @param
     */
    public function setTile($title){
        $this->title = $title;
    }

    /**
     * @return
     */
    public function getSlug(){
        return $this->slug;
    }

    /**
     * @param
     */
    public function setSlug($slug){
        $this->slug = $slug;
    }

    /**
   	 * @Mapping\OneToMany(targetEntity="\Home\Entity\Books", mappedBy="categories")
     * @Mapping\JoinColumn(name="id", referencedColumnName="category_id")
     */
    
    protected $book;
     
  /*
   * Returns associated post.
   * @return \Home\Entity\Books
   */
  public function getBook() 
  {
    return $this->book;
  }

  public function setBook($book) 
  {
    
  }
  
    
}


?>