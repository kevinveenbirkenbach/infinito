<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\FullPersonNameSourceAttribut;
use App\Entity\Source\Data\AbstractDataSource;

class PersonIdentitySource extends AbstractDataSource implements PersonIdentitySourceInterface
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
