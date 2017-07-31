<?php

namespace Admin\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * OrderProductStep
 * @ORM\Entity (repositoryClass="App\Repository\OrderProductStepRepository")
 * @ORM\Table(name="order_product_step")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class OrderProductStep
{
	/**
     * @var integer
     *
     * @ORM\Column(name="order_product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="OrderProduct")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $orderProductId;

    /**
     * @var integer
     *
     * @ORM\Column(name="step", type="integer", nullable=false)
     * @ORM\Id
     */
    private $step;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="supplier_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $supplierId;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
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
     * Get orderProductId
     *
     * @return integer 
     */
    public function getOrderProductId()
    {
        return $this->orderProductId;
    }

    /**
     * Set orderProductId
     *
     * @param integer $orderProductId
     * @return OrderProductStep
     */
    public function setOrderProductId($orderProductId)
    {
        $this->orderProductId = $orderProductId;

        return $this;
    }

	/**
     * Get step
     *
     * @return integer 
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set step
     *
     * @param integer $step
     * @return OrderProductStep
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get supplierId
     *
     * @return integer 
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * Set supplierId
     *
     * @param integer $supplierId
     * @return OrderProductStep
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;

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
     * @return OrderProductStep
     */
    public function setDeletedAt($deleted_at)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
