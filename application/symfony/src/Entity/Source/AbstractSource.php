<?php

namespace App\Entity\Source;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;
use App\Entity\AbstractEntity;
use App\Entity\Attribut\LawAttribut;
use App\Entity\Meta\LawInterface;
use App\Entity\Meta\Law;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Attribut\CreatorRelationAttribut;
use App\Entity\Meta\Relation\Parent\CreatorRelationInterface;
use App\Entity\Meta\Relation\Parent\CreatorRelation;
use App\Entity\Attribut\MemberRelationAttribut;
use App\Entity\Meta\Relation\Member\MemberRelation;
use App\Entity\Meta\Relation\Member\MemberRelationInterface;

/**
 * @author kevinfrantz
 *
 * For the members\memberships attribut checkout:
 *
 * @todo Move parts of discriminator map to subclasses
 *
 * @see http://www.inanzzz.com/index.php/post/h0jt/bidirectional-many-to-many-cascade-remove-and-orphan-removal-operations-in-doctrine
 *
 * @ORM\Entity(repositoryClass="App\Repository\Source\SourceRepository")
 * @ORM\Table(name="source")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 * "pure" = "PureSource",
 * "text" = "App\Entity\Source\Primitive\Text\TextSource",
 * "operation"="App\Entity\Source\Operation\AbstractOperation",
 * "user" = "App\Entity\Source\Complex\UserSource",
 * "fullpersonname" = "App\Entity\Source\Complex\FullPersonNameSource",
 * "personidentitysource"="App\Entity\Source\Complex\PersonIdentitySource",
 * "fullpersonnamesource"="App\Entity\Source\Complex\FullPersonNameSource",
 * "member" = "App\Entity\Source\Complex\Collection\TreeCollectionSource",
 * "and" = "App\Entity\Source\Operation\AndOperation",
 * "nickname" = "App\Entity\Source\Primitive\Name\NicknameSource",
 * "firstname" = "App\Entity\Source\Primitive\Name\FirstNameSource",
 * "surname" = "App\Entity\Source\Primitive\Name\SurnameSource"
 * })
 * @UniqueEntity("slug",ignoreNull=true)
 */
abstract class AbstractSource extends AbstractEntity implements SourceInterface
{
    use  LawAttribut,CreatorRelationAttribut, MemberRelationAttribut;

    /**
     * @var CreatorRelationInterface
     * @ORM\OneToOne(targetEntity="App\Entity\Meta\Relation\Parent\CreatorRelation",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="creator_relation_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    protected $creatorRelation;

    /**
     * @var MemberRelationInterface
     * @ORM\OneToOne(targetEntity="App\Entity\Meta\Relation\Member\MemberRelation",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="member_relation_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    protected $memberRelation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Meta\Law",cascade={"persist", "remove"})
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
