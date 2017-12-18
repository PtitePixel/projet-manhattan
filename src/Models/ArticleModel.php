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
     * @Column(name="art_price", type="integer", length=10, nullable=false)
     */
    private $artPrice;

    /**
     * @Column(name="art_description", type="string", length=1000, nullable=false)
     */
    private $artDescription;
    
     /**
     * @Column (name="art_categorie ", type="string", length=50, nullable=false)
     */
    private $artCategorie ;
    
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

    
}
