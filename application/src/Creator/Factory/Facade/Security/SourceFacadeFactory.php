<?php

namespace App\Creator\Factory\Facade\Security;

use App\Structur\Facade\Security\Source\SourceFacadeInterface;

/**
 * @author kevinfrantz
 */
final class SourceFacadeFactory
{
    public function getSourceFacade(): SourceFacadeInterface
    {
        $className = $this->getSourceFacadeClassName();

        return new $className();
    }

    private function getSourceFacadeClassName(): string
    {
        return 'App\Structur\Facade\Security\Source\\'.$this->getSourceFacadeClassName().'Facade';
    }
}
