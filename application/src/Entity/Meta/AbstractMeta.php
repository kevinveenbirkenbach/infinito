<?php

namespace App\Entity\Meta;

use App\Entity\AbstractEntity;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Source\SourceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @todo Implement source attribut
 *
 * @author kevinfrantz
 */
abstract class AbstractMeta extends AbstractEntity implements MetaInterface
{
    use SourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SourceInterface
     */
    protected $source;

    public function __construct()
    {
        parent::__construct();
    }
}
