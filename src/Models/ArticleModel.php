<?php


namespace Models;

/**
 * @Entity()
 * @Table(name="article")
 */
class ArticleModel {
    
    /**
     * @Id()
     * @GeneratedValue()
     * @Column(name="art_id", type="integer", nullable=false)
     */
    protected $artId;

    /**
     * @Column(name="art_title", type="string", length=100, nullable=false)
     */
    private $artTitle;

    /**
<<<<<<< HEAD
     * @Column(name="art_price", type="float", length=100, nullable=false)
=======
     * @Column(name="art_price", type="float", length=10, nullable=false)
>>>>>>> fb367c10090281d793c8dbd13620ba537b053f94
     */
    private $artPrice;

    /**
     * @Column(name="art_description", type="string", length=1000, nullable=false)
     */
    private $artDescription;
    
     /**
     * @Column (name="art_categorie", type="string", length=50, nullable=false)
     */
    private $artCategorie ;
    
     /**
     * @Column (name="art_picture", type="string", length=50, nullable=false)
     */
    private $artPicture ;
    
    // Getter
    function getArtId() {
        return $this->artId;
    }

    function getArtTitle() {
        return $this->artTitle;
    }

    function getArtPrice() {
        return $this->artPrice;
    }

    function getArtDescription() {
        return $this->artDescription;
    }
    
    function getArtCategorie() {
        return $this->artCategorie;
    }
  

        // Setter
    function setArtTitle($artTitle) {
        $this->artTitle = $artTitle;
        return $this;
    }

    function setArtPrice($artPrice) {
        $this->artPrice = $artPrice;
        return $this;
    }

    function setArtDescription($artDescription) {
        $this->artDescription = $artDescription;
        return $this;
    }
    
   function setArtCategorie($artCategorie) {
        $this->artCategorie = $artCategorie;
        return $this;
    }
    
    //image upload****************************
    
     /**
     * @ORM\Column(type="string")
     *
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    function setArtPicture($artPicture) {
        $this->artPicture = $artPicture;
        return $this;
    }
      
    function getArtPicture() {
        return $this->artPicture;
    }
    

    
}
