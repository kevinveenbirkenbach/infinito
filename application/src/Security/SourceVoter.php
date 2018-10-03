<?php
namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use App\DBAL\Types\RightType;
use App\Entity\SourceInterface;
use App\DBAL\Types\LayerType;
use App\Entity\UserInterface;

/**
 *
 * @author kevinfrantz
 * @see https://symfony.com/doc/current/security/voters.html
 */
class SourceVoter extends Voter
{

    /**
     *
     * @var string[] $attribute
     * @var SourceInterface $subject
     * {@inheritdoc}
     * @see \Symfony\Component\Security\Core\Authorization\Voter\Voter::supports()
     */
    protected function supports($attribute, $subject)
    {
        return $this->checkInstance($subject) &&  $this->checkRight($attribute);
    }
    
    //private function checkLayer(string $layer):bool{
    //    return (in_array($right, array_keys(LayerType::getChoices())));
    //}
    
    private function checkRight(string $right):bool{
        return (in_array($right, array_keys(RightType::getChoices())));
    }
    
    private function checkInstance($subject):bool{
        return ($subject instanceof SourceInterface);
    }

    /**
     * @todo add if father, that it should have all rights!
     * @param string[] $attribute
     * @param SourceInterface $subject
     * @param TokenInterface $token
     * {@inheritdoc}
     * @see \Symfony\Component\Security\Core\Authorization\Voter\Voter::voteOnAttribute()
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /**
         * @var UserInterface $user
         */
        $user = $token->getUser();
        return $subject->getNode()
            ->getLaw()
            ->isGranted($user->getSource()->getNode(), LayerType::SOURCE, $attribute);
    }
}

