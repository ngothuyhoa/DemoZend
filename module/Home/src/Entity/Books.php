<?php
namespace Home\Entity;
use Doctrine\ORM\Mapping as Mapping;
use Home\Entity\Images;
use Home\Entity\Categories;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Mapping\Entity
 * @Mapping\Table(name="books")
 */
class Books{
    //`id`, `category_id`, `name`, `price`, `content`, `description`, `add_information`

    /**
     * @Mapping\Id
     * @Mapping\Column(type="integer")
     * @Mapping\GeneratedValue
     */
    private $id;

    /** @Mapping\Column(type="integer") */
    private $category_id;

    /** @Mapping\Column(type="string") */
    private $name;

    /** @Mapping\Column(type="integer") */
    private $price;

     /** @Mapping\Column(type="string") */
    private $content;

     /** @Mapping\Column(type="string") */
    private $description;

     /** @Mapping\Column(type="string") */
    private $add_information;

     
    protected $images;

    /**
     * @Mapping\OneToMany(targetEntity="\Home\Entity\Categories", mappedBy="books")
     * @Mapping\JoinColumn(name="category_id", referencedColumnName="id")
     */

    protected $categories;
    
    // Constructor.
    public function __construct() 
    { 
    //...  
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();  
    }

    //`id`, `category_id`, `name`, `price`, `content`, `description`, `add_information`

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
    public function getCategoryId(){
        return $this->category_id;
    }

    /**
     * @param
     */
    public function setCategoryId($id){
        $this->category_id = $category_id;
    }
    
    /**
     * @return
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param
     */
    public function setName($name){
        $this->name = $name;
    }
    
    /**
     * @return
     */
    public function getPrice(){
        return $this->price;
    }

    /**
     * @param
     */
    public function setPrice($price){
        $this->price = $price;
    }
    
    /**
     * @return
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * @param
     */
    public function setContent($content){
        $this->content = $content;
    }

    /**
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * 
     * @param 
     */
    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    /**
     * @return string
     */
    public function getAddInformation()
    {
        return $this->add_information;
    }
    
    /**
     * @param
     */
    public function setAddInformation($add_information) 
    {
        $this->add_information = $add_information;
    }

   

    // Returns tags for this post.
    public function getImages() 
    {
        return $this->images;
    }      
    
    // Adds a new image to this post.
    public function addImages($image) 
    {
        $this->images[] = $image;        
    }
    
    // Removes association between this post and the given tag.
    public function removeTagAssociation($image) 
    {
        $this->images->removeElement($image);
    }

    public function getCategories() 
    {
        return $this->categories;
    }

    public function setCategories($categories) 
    {
    }
}


?>