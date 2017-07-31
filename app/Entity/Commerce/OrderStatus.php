<?php

namespace App\Entity\Commerce;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents an OrderStatus.
 * Note that this class extends Status
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="order_status")
 **/
class OrderStatus extends Status
{
    

  
}