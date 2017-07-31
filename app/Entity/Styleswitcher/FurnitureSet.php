<?php

namespace App\Entity\Styleswitcher;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FurnitureSet
 * 
 * @ORM\Entity
 * @ORM\Table(name="furniture_set")
 */
class FurnitureSet
{
	/**
     * @var integer
     *
     * @ORM\Column(name="room_layout_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $roomLayoutId;

    /**
     * @var integer
     *
     * @ORM\Column(name="target_audience_id", type="integer", nullable=false)
     */
    private $targetAudienceId;

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

    /**
     * @ORM\ManyToOne(targetEntity="RoomLayout", inversedBy="roomLayoutTargetAudiences")
     * @ORM\JoinColumn(name="room_layout_id", referencedColumnName="id")
     */
    private $roomLayout;

    /**
     * @ORM\ManyToOne(targetEntity="TargetAudience", inversedBy="roomLayoutTargetAudiences")
     * @ORM\JoinColumn(name="target_audience_id", referencedColumnName="id")
     */
    private $targetAudience;


    /************** Getters & Setters ************/

    /**
     * Get roomLayoutId
     *
     * @return integer 
     */
    public function getRoomLayoutId()
    {
        return $this->roomLayoutId;
    }

    /**
     * Set roomLayoutId
     *
     * @param integer $roomLayoutId
     * @return FurnitureSet
     */
    public function setRoomLayoutId($roomLayoutId)
    {
        $this->roomLayoutId = $roomLayoutId;

        return $this;
    }

    /**
     * Get targetAudienceId
     *
     * @return integer 
     */
    public function getTargetAudienceId()
    {
        return $this->targetAudienceId;
    }

    /**
     * Set targetAudienceId
     *
     * @param integer $targetAudienceId
     * @return FurnitureSet
     */
    public function setTargetAudienceId($targetAudienceId)
    {
        $this->targetAudienceId = $targetAudienceId;

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
     * @return FurnitureSet
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
     * @return FurnitureSet
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
     * @return FurnitureSet
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }    
}