<?php

namespace App\Entity\Supplier;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SupplierType
 *
 * @ORM\Entity(repositoryClass="\App\Repository\SupplierTypeRepository")
 * @ORM\Table(name="supplier_type")
 */

class SupplierType
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
     * get Id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set name
     *
     * @param string $name
     * @return SupplierType
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
}
