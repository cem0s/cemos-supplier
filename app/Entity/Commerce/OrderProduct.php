<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * OrderProduct
 * @ORM\Entity(repositoryClass="\App\Repository\OrderProductRepository")
 * @ORM\Table(name="order_product")
 */

class OrderProduct
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
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;


    /**
     * @var decimal
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var array
     *
     * @ORM\Column(name="data", type="array", nullable=false)
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="step", type="integer")
     */
    private $step=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="upgrade_of_id", type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="OrderProduct")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $upgradeOfId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Order")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Column(name="supplier_id", type="integer")
     * @ORM\OneToOne(targetEntity="Supplier")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $supplierId;

    /**
     * @var integer
     *
     * @ORM\Column(name="supplier_user_id", type="integer")
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $supplierUserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_product_status_id", type="integer", nullable=false)
     * @ORM\OneToOne(targetEntity="OrderProductStatus")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $orderProductStatusId;


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
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderProduct
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

     /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

	/**
     * Set price
     *
     * @param decimal $price
     * @return OrderProduct
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

     /**
     * Get price
     *
     * @return decimal 
     */
    public function getPrice()
    {
        return $this->price;
    }

	/**
     * Set data
     *
     * @param array $data
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
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

	/**
     * Set step
     *
     * @param integer $step
     * @return OrderProduct
     */
    public function setStep($step)
    {
        $this->step = $step;

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
     * Set upgrade_of_id
     *
     * @param integer $upgradeOfId
     * @return OrderProduct
     */
    public function setUpgradeOfId($upgradeOfId)
    {
        $this->upgradeOfId = $upgradeOfId;

        return $this;
    }

     /**
     * Get upgrade_of_id
     *
     * @return integer 
     */
    public function getUpgradeOfId()
    {
        return $this->upgradeOfId;
    }


	/**
     * Set order_id
     *
     * @param integer $orderId
     * @return OrderProduct
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

     /**
     * Get order_id
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }


 	/**
     * Set product_id
     *
     * @param integer $productId
     * @return OrderProduct
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

     /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

	/**
     * Set supplier_id
     *
     * @param integer $supplierId
     * @return OrderProduct
     */
    public function setSupplierId($supplierId)
    {
        $this->supplierId = $supplierId;

        return $this;
    }

     /**
     * Get supplier_id
     *
     * @return integer 
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * Set supplier_user_id
     *
     * @param integer $supplierId
     * @return OrderProduct
     */
    public function setSupplierUserId($supplierUserId)
    {
        $this->supplierUserId = $supplierUserId;

        return $this;
    }

     /**
     * Get supplier_user_id
     *
     * @return integer 
     */
    public function getSupplierUserId()
    {
        return $this->supplierUserId;
    }


	/**
     * Set order_product_status_id
     *
     * @param integer $orderProductStatusId
     * @return OrderProduct
     */
    public function setOrderProductStatusId($orderProductStatusId)
    {
        $this->orderProductStatusId = $orderProductStatusId;

        return $this;
    }

     /**
     * Get order_product_status_id
     *
     * @return integer 
     */
    public function getOrderProductStatusId()
    {
        return $this->orderProductStatusId;
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
     * @return OrderProduct
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }


}//end of class
