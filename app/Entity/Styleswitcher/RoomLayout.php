<?php

namespace App\Entity\Styleswitcher;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * RoomLayout
 * @ORM\Table(name="room_layout")
 * @ORM\Entity
 */
class RoomLayout
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
     * @var integer
     *
     * @ORM\Column(name="room_id", type="integer", nullable=false)
     */
    private $roomId;

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
    * @ORM\ManyToOne(targetEntity="Room", inversedBy="roomLayouts")
    * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
    */ 
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="RoomLayoutTargetAudience", mappedBy="roomLayout")
     */
   // private $roomLayoutTargetAudiences;


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
     * @return Room
     */
    public function setName($name='')
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set roomId
     *
     * @param integer $roomId
     * @return RoomLayout
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

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
     * @return RoomLayout
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}