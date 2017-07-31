<?php

namespace App\Entity\Realestate;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents a commercial object.
 * Note that this class extends Object
 */

/**
 * @ORM\Entity @ORM\Table(name="commercial_object")
 **/
class CommercialObject extends Object
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