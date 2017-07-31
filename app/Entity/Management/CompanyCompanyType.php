<?php
namespace App\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * CompanyCompanyType
 * 
 * @ORM\Entity
 * @ORM\Table(name="company_company_type")
 */
class CompanyCompanyType
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="id")
     */
    private $companyId;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="company_type_id", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="CompanyType", inversedBy="id")
     */
    private $companyTypeId;
    
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
     * Set companyId
     *
     * @param integer $companyId
     * @return CompanyCompanyType
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }
    
    /**
     * Set companyTypeId
     *
     * @param integer $companyTypeId
     * @return CompanyCompanyType
     */
    public function setCompanyTypeId($companyTypeId)
    {
        $this->companyTypeId = $companyTypeId;

        return $this;
    }

    /**
     * Get companyTypeId
     *
     * @return integer 
     */
    public function getCompanyTypeId()
    {
        return $this->companyTypeId;
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
     * @return CompanyCompanyType
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

}
?>
