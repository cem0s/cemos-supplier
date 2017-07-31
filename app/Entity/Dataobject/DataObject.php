<?php

namespace App\Entity\Dataobject;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ObjectStore
 * @ORM\Entity
 * @ORM\Table(name="data_object")
 */

class DataObject
{
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="url_expires", type="datetime", nullable=true)
     */
    private $urlExpires;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_type", type="string", nullable=true)
     */
    private $ownerType;

    /**
     * @var integer
     *
     * @ORM\Column(name="owner_id", type="integer", nullable=true)
     */
    private $ownerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="container_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Container")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $containerId;

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


    /******** Getters & Setters **************/

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
     * @return DataObject
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /** Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return DataObject
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /** Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get url_expires
     *
     * @return datetime 
     */
    public function getUrlExpires()
    {
        return $this->urlExpires;
    }

    /**
     * Set url_expires
     *
     * @param integer $urlExpires
     * @return DataObject
     */
    public function setUrlExpires($urlExpires)
    {
        $this->urlExpires = $urlExpires;

        return $this;
    }

	/**
     * Set ownerType
     *
     * @param string $ownerType
     * @return DataObject
     */
    public function setOwnerType($ownerType)
    {
        $this->ownerType = $ownerType;

        return $this;
    }

    /** Get ownerType
     *
     * @return string 
     */
    public function getOwnerType()
    {
        return $this->ownerType;
    }

	/**
     * Set ownerId
     *
     * @param integer $ownerId
     * @return DataObject
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /** Get ownerId
     *
     * @return integer 
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

	/**
     * Set containerId
     *
     * @param integer $containerId
     * @return DataObject
     */
    public function setContainerId($containerId)
    {
        $this->containerId = $containerId;

        return $this;
    }

    /** Get containerId
     *
     * @return integer 
     */
    public function getContainerId()
    {
        return $this->containerId;
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
     * Get deleted_at
     *
     * @return datetime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set deleted_at
     *
     * @param integer $deletedAt
     * @return DataObject
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }


}
