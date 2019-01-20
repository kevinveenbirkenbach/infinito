<?php

namespace App\Entity;

use App\Entity\Attribut\IdAttribut;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\VersionAttribut;
use App\Entity\Attribut\SlugAttribut;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 */
abstract class AbstractEntity implements EntityInterface
{
    use IdAttribut, VersionAttribut,SlugAttribut;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @version @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $version;

    /**
     * System slugs should be writen in UPPER CASES
     * Slugs which are defined by the user are checked via the assert.
     *
     * @ORM\Column(type="string",length=30,nullable=true,unique=true)
     * @Assert\Regex(pattern="/^[a-z]+$/")
     *
     * @todo Check out if a plugin can solve this purpose;
     *
     * @see https://github.com/Atlantic18/DoctrineExtensions/blob/master/doc/sluggable.md
     *
     * @var string
     */
    protected $slug;
    
    public function __construct()
    {
        $this->version = 0;
    }
}
