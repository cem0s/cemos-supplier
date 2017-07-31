<?php
namespace App\Entity\Styleswitcher;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Style
 * 
 * @ORM\Entity
 * @ORM\Table(name="furniture_set_style")
 */
class FurnitureSetStyle 
{

    /**
     * @var integer
     *
     * @ORM\Column(name="furniture_set_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    
    private $furnitureSetId;

    /**
     * @var integer
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="style_id", type="integer", nullable=false)
     */
    private $styleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=false)
     */
    private $imageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=true)
     */
    private $thumbId;

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

    /*     * ************ Getters & Setters *********** */

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->furnitureSetId;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getStyleId() {
        return $this->styleId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Style
     */
    public function setStyleId($id = '') {
        $this->styleId = $id;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageId() {
        return $this->imageId;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Style
     */
    public function setImageId($imageId = '') {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * Get thumbUrl
     *
     * @return string 
     */
    public function getThumbId() {
        return $this->thumbId;
    }

    /**
     * Set thumbUrl
     *
     * @param string $thumbUrl
     * @return Style
     */
    public function setThumbId($thumbId = '') {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     *
     * @return datetime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get deletedAt
     *
     * @return datetime
     */
    public function getDeletedAt() {
        return $this->deletedAt;
    }

    /**
     * Set deletedAt
     *
     * @param integer $deletedAt
     * @return Style
     */
    public function setDeletedAt($deletedAt) {
        $this->deletedAt = $deletedAt;

        return $this;
    }

}
