<?php

namespace App\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Region
 * @ORM\Entity
 * @ORM\Table(name="region")
 */
class Region
{
	/**
    * @var integer
    *
    * @ORM\Column(name="id", type="integer", nullable=false)
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
    * @var json_array
    *
    * @ORM\Column(name="data", type="json_array", nullable=true)
    */
    private $data;
	
	/**
     * @ORM\Column(name="country", type="string")
     */
    protected $country;
	
	/**
	* @@ORM\ManyToMany(targetEntity="User" mappedBy="regions")
	* @var User[]
	*/
	private $users;

    /**
    * @var \DateTime $created_at
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="created_at", type="datetime", nullable=false)
    */
    private $createdAt;

    /**
    * @var \DateTime $updated_at
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="updated_at", type="datetime", nullable=false)
    */
    private $updatedAt;
     
    /**
    * @var \DateTime $deleted_at
    *
    * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
    */
    private $deletedAt;

	public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
	
	/**
     * Get users
     *
     * @return Users
     */
    public function getUsers()
    {
        return $this->users;
    }

        /************ Getters and setters ***********/

    /**
    * Get id
    *
    * @return integer 
    */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    * Set data
    *
    * @param array $data
    * @return data
    */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
    * Get data
    *
    * @return array 
    */
    public function getData()
    {
        return $this->data;
    }
	
	/**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return country
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
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
    * @return Region
    */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

}