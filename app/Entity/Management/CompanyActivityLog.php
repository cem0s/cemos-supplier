<?php

namespace App\Entity\Management;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


/**
 * CompanyActivityLog
 * @ORM\Entity(repositoryClass="\App\Repository\ActivityLogRepository")
 * @ORM\Table(name="company_activity_log")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */

class CompanyActivityLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $companyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $userId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", nullable=false)
     */
    private $category;

     /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", nullable=false)
     */
    private $action;
    
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
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set companyId
     *
     * @param integer $companyId
     * @return Order
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Order
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return OrderProduct
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
    
 
     /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return CompanyActivityLog
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
    
 
     /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

     /**
     * Set action
     *
     * @param string $action
     * @return CompanyActivityLog
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
    
 
     /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
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
     * @return Client
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}