<?php

namespace App\Entity\Realestate;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * This class represents an ObjectType item, either a Residential or a Commercial.
 * It is abstract because we never have an ObjectType entity, it's either a residential or a commercial.
 * @ORM\Entity(repositoryClass="\App\Repository\ObjectTypeRepository")
 * @ORM\Table(name="object_type")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap( {"residential" = "ResidentialObjectType", "commercial" = "CommercialObjectType"} )
 */

abstract class ObjectType
{


	/**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

	
    /** Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ObjectType
     */
    public function setName( $name )
    {
        $this->name = $name;
    }

    /** Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

  

}