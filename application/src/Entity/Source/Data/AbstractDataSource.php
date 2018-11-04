<?php
namespace App\Entity\Source\Data;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\AbstractSource; 
/**
 * @author kevinfrantz
 *
 * @ORM\Entity
 * @ORM\Table(name="source_data")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "UserSource","name" = "NameSource"})
 */
abstract class AbstractDataSource extends AbstractSource implements DataSourceInterface
{
    
}

