<?php

namespace Infinito\Entity\Source;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\CreatorRelationAttribut;
use Infinito\Attribut\LawAttribut;
use Infinito\Attribut\MemberRelationAttribut;
use Infinito\Attribut\SlugAttribut;
use Infinito\Entity\AbstractEntity;
use Infinito\Entity\Meta\Law;
use Infinito\Entity\Meta\LawInterface;
use Infinito\Entity\Meta\Relation\Member\MemberRelation;
use Infinito\Entity\Meta\Relation\Member\MemberRelationInterface;
use Infinito\Entity\Meta\Relation\Parent\CreatorRelation;
use Infinito\Entity\Meta\Relation\Parent\CreatorRelationInterface;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 *
 * For the members\memberships attribut checkout:
 *
 * @todo Move parts of discriminator map to subclasses
 *
 * @see http://www.inanzzz.com/index.php/post/h0jt/bidirectional-many-to-many-cascade-remove-and-orphan-removal-operations-in-doctrine
 *
 * @ORM\Entity(repositoryClass="Infinito\Repository\Source\SourceRepository")
 * @ORM\Table(name="source")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 * "pure" = "PureSource",
 * "text" = "Infinito\Entity\Source\Primitive\Text\TextSource",
 * "operation"="Infinito\Entity\Source\Operation\AbstractOperation",
 * "user" = "Infinito\Entity\Source\Complex\UserSource",
 * "fullpersonname" = "Infinito\Entity\Source\Complex\FullPersonNameSource",
 * "personidentitysource"="Infinito\Entity\Source\Complex\PersonIdentitySource",
 * "fullpersonnamesource"="Infinito\Entity\Source\Complex\FullPersonNameSource",
 * "member" = "Infinito\Entity\Source\Complex\Collection\TreeCollectionSource",
 * "and" = "Infinito\Entity\Source\Operation\AndOperation",
 * "nickname" = "Infinito\Entity\Source\Primitive\Name\NicknameSource",
 * "firstname" = "Infinito\Entity\Source\Primitive\Name\FirstNameSource",
 * "surname" = "Infinito\Entity\Source\Primitive\Name\SurnameSource"
 * })
 * @UniqueEntity("slug",ignoreNull=true)
 */
abstract class AbstractSource extends AbstractEntity implements SourceInterface
{
    use  LawAttribut;
    use CreatorRelationAttribut;
    use MemberRelationAttribut;
    use SlugAttribut;

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

    /**
     * @var CreatorRelationInterface
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Meta\Relation\Parent\CreatorRelation",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="creator_relation_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    protected $creatorRelation;

    /**
     * @var MemberRelationInterface
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Meta\Relation\Member\MemberRelation",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="member_relation_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    protected $memberRelation;

    /**
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Meta\Law",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var LawInterface
     */
    protected $law;

    public function __construct()
    {
        parent::__construct();
        $this->creatorRelation = new CreatorRelation();
        $this->creatorRelation->setSource($this);
        $this->memberRelation = new MemberRelation();
        $this->memberRelation->setSource($this);
        $this->law = new Law();
        $this->law->setSource($this);
    }
}
