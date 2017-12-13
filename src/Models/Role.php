<?php


/**
 * Description of Role
 *
 * @author Luxbay
 */
namespace Models;

/**
 * @Entity()
 * @Table(name="role")
 */
class Role
{
    /**
     * @Id()
     * @GeneratedValue()
     * @Column(name="id", type="integer", nullable=false)
     */
    private $id;
    
    /**
     * @Column(name="label", type="string", length=50, nullable=false)
     */
    private $label;
    
    function getId()
    {
        return $this->id;
    }

    function getLabel()
    {
        return $this->label;
    }
    
    function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
}
