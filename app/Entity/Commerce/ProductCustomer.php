<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ProductCustomer
 *
 * @ORM\Entity
 * @ORM\Table(name="product_customer")
 */
class ProductCustomer
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
     * @ORM\Column(name="customer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="id")
     */
    private $customerId;

    /**
     * @var decimal
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var decimal
     *
     * @ORM\Column(name="comm_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $commPrice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", nullable=true)
     */
    private $enabled;

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
     * Set customerId
     *
     * @param integer $customerId
     * @return ProductCustomer
     */
    public function setCustomerId( $customerId )
    {
        $this->customerId = $customerId;

        return $customerId;
    }

    /**
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ProductCustomer
     */
    public function setName($name='')
    {
        $this->name = $name;

        return $this;
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
     * Set commPrice
     *
     * @param string $commPrice
     * @return Product
     */
    public function setCommPrice($commPrice)
    {
        $this->commPrice = $commPrice;

        return $this;
    }

    /**
     * Get commPrice
     *
     * @return Product
     */
    public function getCommPrice()
    {
        return $this->commPrice;
    }


    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return ProductCustomer
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
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
