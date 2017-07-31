<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Order
 * @ORM\Entity(repositoryClass="\App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
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
     * @ORM\Column(name="object_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Object")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $objectId;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="invoice_address_id", type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $invoiceAddressId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_status_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $orderStatusId;


    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /***** Getters and setters *****/

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
     * Get objectId
     *
     * @return integer 
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set objectId
     *
     * @param integer $objectId
     * @return Order
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

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
     * Get invoiceAddressId
     *
     * @return integer 
     */
    public function getInvoiceAddressId()
    {
        return $this->invoiceAddressId;
    }

    /**
     * Set invoiceAddressId
     *
     * @param integer $invoiceAddressId
     * @return Order
     */
    public function setInvoiceAddressId($invoiceAddressId)
    {
        $this->invoiceAddressId = $invoiceAddressId;

        return $this;
    }

    /**
     * Get orderStatusId
     *
     * @return integer 
     */
    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }

    /**
     * Set orderStatusId
     *
     * @param integer $orderStatusId
     * @return Order
     */
    public function setOrderStatusId($orderStatusId)
    {
        $this->orderStatusId = $orderStatusId;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get deletedAt
     *
     * @return datetime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set deletedAt
     *
     * @param integer $deletedAt
     * @return Order
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}