<?php

namespace App\Entity\Realestate;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * This class represents an ObjectType item, either a Residential or a Commercial.
 * It is abstract because we never have an ObjectType entity, it's either a residential or a commercial.
* @ORM\Entity(repositoryClass="\App\Repository\ObjectPropertyRepository")
 * @ORM\Table(name="object_property")
 */


class ObjectProperty

{


	/**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

    /**
     * @ORM\Column(name="object_id", type="integer")
     * @ORM\OneToOne(targetEntity="Object")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $objectId;

    /**
     * @ORM\Column(name="property_type", type="string", nullable=false)
     */
    protected $propertyType;

    /**
     * @ORM\Column(name="built", type="string", nullable=false)
     */
    protected $built;

    /**
     * @ORM\Column(name="built_in", type="string", nullable=true)
     */
    protected $builtIn;

    /**
     * @ORM\Column(name="area", type="string", nullable=true)
     */
    protected $area;

    /**
     * @ORM\Column(name="rooms", type="integer", nullable=true)
     */
    protected $rooms;

    /**
     * @ORM\Column(name="floors", type="integer", nullable=true)
     */
    protected $floors;

    /**
     * @ORM\Column(name="occupied", type="string", nullable=true)
     */
    protected $occupied;

    /**
     * @ORM\Column(name="owner_name", type="string", nullable=true)
     */
    protected $ownerName;

    /**
     * @ORM\Column(name="owner_tel", type="string", nullable=true)
     */
    protected $ownerTel;

    /**
     * @ORM\Column(name="owner_mob", type="string", nullable=true)
     */
    protected $ownerEmail;

    /**
     * @ORM\Column(name="owner_email", type="string", nullable=true)
     */
    protected $ownerMob;

        /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;

	
    /** Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set object_id
     *
     * @param string $objectId
     * @return Object
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /** Get object_id
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set property_type
     *
     * @param string $propertyType
     * @return Object
     */
    public function setPropertyType($propertyType)
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    /** Get property_type
     *
     * @return string
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     * Set built
     *
     * @param string $built
     * @return Object
     */
    public function setBuilt($built)
    {
        $this->built = $built;

        return $this;
    }

    /** Get built
     *
     * @return string
     */
    public function getBuilt()
    {
        return $this->built;
    }

    /**
     * Set built_in
     *
     * @param string $builtIn
     * @return Object
     */
    public function setBuiltIn($builtIn)
    {
        $this->builtIn = $builtIn;

        return $this;
    }

    /** Get built_in
     *
     * @return string
     */
    public function getBuiltIn()
    {
        return $this->builtIn;
    }

    /**
     * Set area
     *
     * @param string $area
     * @return Object
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /** Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set rooms
     *
     * @param integer $rooms
     * @return Object
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    /** Get rooms
     *
     * @return integer
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Set floors
     *
     * @param integer $floors
     * @return Object
     */
    public function setFloors($floors)
    {
        $this->floors = $floors;

        return $this;
    }

    /** Get floors
     *
     * @return integer
     */
    public function getFloors()
    {
        return $this->floors;
    }

    /**
     * Set occupied
     *
     * @param string $occupied
     * @return Object
     */
    public function setOccupied($occupied)
    {
        $this->occupied = $occupied;

        return $this;
    }

    /** Get occupied
     *
     * @return string
     */
    public function getOccupied()
    {
        return $this->occupied;
    }

    /**
     * Set owner_name
     *
     * @param string $ownerName
     * @return Object
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;

        return $this;
    }

    /** Get owner_name
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Set owner_tel
     *
     * @param string $ownerTel
     * @return Object
     */
    public function setOwnerTel($ownerTel)
    {
        $this->ownerTel = $ownerTel;

        return $this;
    }

    /** Get owner_tel
     *
     * @return string
     */
    public function getOwnerTel()
    {
        return $this->ownerTel;
    }

    /**
     * Set owner_mob
     *
     * @param string $ownerMob
     * @return Object
     */
    public function setOwnerMob($ownerMob)
    {
        $this->ownerMob = $ownerMob;

        return $this;
    }

    /** Get owner_mob
     *
     * @return string
     */
    public function getOwnerMob()
    {
        return $this->ownerMob;
    }

    /**
     * Set owner_email
     *
     * @param string $ownerEmail
     * @return Object
     */
    public function setOwnerEmail($ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;

        return $this;
    }

    /** Get owner_email
     *
     * @return string
     */
    public function getOwnerEmail()
    {
        return $this->ownerEmail;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * Set deleted_at
     *
     * @param integer $deletedAt
     * @return Object
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deleted_at
     *
     * @return datetime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}