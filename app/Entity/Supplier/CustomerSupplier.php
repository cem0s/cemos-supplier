<?php

namespace App\Entity\Supplier;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CustomerSupplier
 *
 * @ORM\Entity
 * @ORM\Table(name="customer_supplier")
 */

class CustomerSupplier
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="customer_id", type="integer", nullable=false)
     * @ORM\OneToMany(targetEntity="Company", mappedBy="CustomerSupplier")
     */
    private $customerId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="supplier_type_id", type="integer", nullable=false)
     * @ORM\OneToMany(targetEntity="SupplierType", mappedBy="CustomerSupplier")
     */
    private $supplierTypeId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="supplier_id", type="integer", nullable=false)
     * @ORM\OneToMany(targetEntity="Company", mappedBy="CustomerSupplier")
     */
    private $supplierId;

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

    /**
     * set customerId
     *
     * @param integer $customerId
     * @return CustomerSupplier
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * set supplierTypeId
     *
     * @param integer $supplierTypeId
     * @return CustomerSupplier
     */
    public function setSupplierTypeId($supplierTypeId)
    {
        $this->supplierTypeId = $supplierTypeId;
        return $this;
    }

    /**
     * get supplierTypeId
     *
     * @return integer
     */
    public function getSupplierTypeId()
    {
        return $this->supplierTypeId;
    }

    /**
     * set supplierId
     *
     * @param integer $supplierId
     * @return CustomerSupplier
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;
        return $this;
    }

    /**
     * get supplierId
     *
     * @return integer
     */
    public function getSupplierId()
    {
        return $this->supplierId;
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
     * Set deletedAt
     *
     * @param integer $deletedAt
     * @return CustomerSupplier
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
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
}
