<?php

namespace App\Entity\Supplier;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SupplierRule
 *
 * @ORM\Entity
 * @ORM\Table(name="supplier_rule")
 */

class SupplierRule
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @ORM\OneToMany(targetEntity="Product", mappedBy="SupplierRule")
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="supplier_type_id", type="integer", nullable=false)
     * @ORM\OneToMany(targetEntity="SupplierType", mappedBy="SupplierRule")
     */
    private $supplierTypeId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="step", type="integer", nullable=true)
     */
    private $step;

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
     * set productId
     *
     * @param integer $productId
     * @return SupplierRule
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * set supplierTypeId
     *
     * @param integer $supplierTypeId
     * @return SupplierRule
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
     * set step
     *
     * @param integer $step
     * @return SupplierRule
     */
    public function setStep($step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * get step
     *
     * @return integer
     */
    public function getStep()
    {
        return $this->step;
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
     * @return SupplierRule
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

