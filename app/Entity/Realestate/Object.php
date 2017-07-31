<?php

namespace App\Entity\Realestate;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * This class represents an Object item, either a Residential or a Commercial.
 * It is abstract because we never have an Object entity, it's either a residential or a commercial.
 * @ORM\Entity(repositoryClass="\App\Repository\ObjectRepository")
 * @ORM\Table(name="object")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap( {"residential" = "ResidentialObject", "commercial" = "CommercialObject"} )
 *
 */
abstract class Object
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
    // concatenate: address1 + ', ' + town
    protected $name;

    /**
     * @ORM\Column(name="address1", type="string")
     */
    protected $address1;

    /**
     * @ORM\Column(name="address2", type="string")
     */
    protected $address2;

    /**
     * @ORM\Column(name="zipcode", type="string", nullable=true)
     */
    protected $zipcode;

    /**
     * @ORM\Column(name="town", type="string")
     */
    protected $town;

    /**
     * @ORM\Column(name="country", type="string", length=2)
     */
    protected $country;

    /**
     * @Gedmo\Slug(fields={"name"}, updatable=true, unique=true, style="default")
     * @ORM\Column(name="slug", type="string")
     */
    protected $slug;

    /**
     * @ORM\Column(name="object_type_id", type="integer")
     * @ORM\OneToOne(targetEntity="ObjectType")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $objectTypeId;

    /**
     * @ORM\Column(name="region_id", type="integer", nullable=true)
     * @ORM\OneToMany(targetEntity="Region")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $regionId;

    /**
     * @ORM\Column(name="customer_id", type="integer")
     * @ORM\OneToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    protected $customerId; //reference to company->id

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId; //reference to user->id

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

    /***** Getters and setters *****/

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
     * @return Object
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
     * Set address1
     *
     * @param string $address1
     * @return Object
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /** Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Object
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /** Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Object
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /** Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Object
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /** Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Object
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /** Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Object
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /** Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set objectTypeId
     *
     * @param integer $objectTypeId
     * @return Object
     */
    public function setObjectTypeId($objectTypeId)
    {
        $this->objectTypeId = $objectTypeId;

        return $this;
    }

    /** Get objectTypeId
     *
     * @return integer
     */
    public function getObjectTypeId()
    {
        return $this->objectTypeId;
    }

    /**
     * Set regionId
     *
     * @param integer $regionId
     * @return Object
     */
    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;

        return $this;
    }

    /** Get regionId
     *
     * @return integer
     */
    public function getRegionId()
    {
        return $this->regionId;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return Object
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /** Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Object
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /** Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
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
