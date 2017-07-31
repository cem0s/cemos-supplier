<?php
namespace App\Entity\Management;

use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company_closure")
 */
class CompanyClosure extends AbstractClosure
{

}
?>