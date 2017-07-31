<?php

namespace App\Entity\Realestate;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a residential object.
 * Note that this class extends Object
 */

/**
 * @ORM\Entity @ORM\Table(name="residential_object")
 **/
class ResidentialObject extends Object
{
    /**
     * @ORM\Column(name="object_type_id", type="integer")
     */
    protected $objectTypeId;
	


    /***** Getters and setters *****/
    public function getObjectTypeId()
    {
        return $this->objectTypeId;
    }

  
}