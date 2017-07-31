<?php

namespace App\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Region
 * @ORM\Entity
 * @ORM\Table(name="user_activation_code")
 */
class UserActivationCode
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
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

	/**
     * @ORM\Column(name="code", type="string")
     */
    protected $code;
	
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
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return user_id
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
    * Set code
    *
    * @param string $code
    * @return code
    */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

      /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
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