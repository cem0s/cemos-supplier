<?php

namespace App\Entity\Styleswitcher;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Style
 * 
 * @ORM\Entity
 * @ORM\Table(name="style")
 */
class Style
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
	 * @var string
	 *
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
	 * @var string
	 *
     * @ORM\Column(name="image_url", type="string", nullable=false)
     */
    private $imageUrl;

    /**
	 * @var string
	 *
     * @ORM\Column(name="thumb_url", type="string", nullable=true)
     */
    private $thumbUrl;

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

    /************** Getters & Setters ************/

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
     * @return Style
     */
    public function setName($name='')
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Style
     */
    public function setImageUrl($imageUrl='')
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get thumbUrl
     *
     * @return string 
     */
    public function getThumbUrl()
    {
        return $this->thumbUrl;
    }

    /**
     * Set thumbUrl
     *
     * @param string $thumbUrl
     * @return Style
     */
    public function setThumbUrl($thumbUrl='')
    {
        $this->thumbUrl = $thumbUrl;

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
     * @return Style
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }  
}