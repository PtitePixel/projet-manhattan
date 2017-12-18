<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
     * @Column(name="label", type="string", length=12, nullable=false)
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
