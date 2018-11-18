<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\FullPersonNameSourceAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_combination_person_identity")
 * @ORM\Entity()
 */
class PersonIdentitySource extends AbstractCombinationSource implements PersonIdentitySourceInterface
{
    use FullPersonNameSourceAttribut;

    /**
     * @var FullPersonNameSourceInterface
     */
    protected $fullPersonNameSource;

    public function __construct()
    {
        parent::__construct();
        $this->fullPersonNameSource = new FullPersonNameSource();
    }
}
