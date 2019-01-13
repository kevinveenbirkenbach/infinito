<?php
namespace App\Domain\RightManagement;

use App\Entity\Meta\Right;
use App\Entity\UserInterface as InfinitoUserInterface;
use App\Entity\Source\SourceInterface;
use App\Entity\UserInterface;
use Symfony\Component\Security\Core\Security;

/**
 *
 * @author kevinfrantz
 *        
 */
final class UserRightService extends Right implements UserRightServiceInterface
{
    /**
     * 
     * @var Security
     */
   private $security;

   
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Entity\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(SourceInterface $reciever):void{
        
    }
    
    public function getReciever():SourceInterface{
        return $this->user->getSource();
    }
}

