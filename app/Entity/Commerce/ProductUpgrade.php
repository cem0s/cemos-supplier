<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProductUpgrade
 * 
 * @ORM\Entity
 * @ORM\Table(name="product_upgrade")
 */
class ProductUpgrade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="id")
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Column(name="upgrade_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="id")
     */
    private $upgradeId;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    
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

    public function __construct()
    {
        // Do nothing.
    }

    /**
     * Set productId
     *
     * @param integer $productId
     * @return ProductCustomer
     */
    public function setProductId( $productId )
    {
        $this->productId = $productId;
        
        return $productId;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set upgradeId
     *
     * @param integer $upgradeId
     * @return ProductUpgrade
     */
    public function setUpgradeId( $upgradeId )
    {
        $this->upgradeId = $upgradeId;
        
        return $upgradeId;
    }

    /**
     * Get upgradeId
     *
     * @return integer 
     */
    public function getUpgradeId()
    {
        return $this->upgradeId;
    }


    /**
     * Set price
     *
     * @param text $price
     * @return ProductCustomer
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return text 
     */
    public function getPrice()
    {
        return $this->price;
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
     * @return ProductCustomer
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
