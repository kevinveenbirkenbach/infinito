<?php

namespace App\Entity\Source\Data;

use App\Entity\Attribut\FullPersonNameSourceAttribut;
use App\Entity\Source\Combination\FullPersonNameSourceInterface;
use App\Entity\Source\Combination\FullPersonNameSource;

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
