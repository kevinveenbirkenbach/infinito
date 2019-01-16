<?php

namespace App\Entity\Attribut;

use App\Exception\NoValidChoiceException;
use App\DBAL\Types\Meta\Right\CRUDType;

/**
 * @todo Implement a trait for crud which substitute this one.
 *
 * @author kevinfrantz
 */
trait CrudAttribut
{
    /**
     * @see CRUDType
     *
     * @var string
     */
    protected $crud;

    /**
     * @param string $crud
     */
    public function setCrud(string $crud): void
    {
        if (!array_key_exists($crud, CRUDType::getChoices())) {
            throw new NoValidChoiceException();
        }
        $this->crud = $crud;
    }

    /**
     * @return string
     */
    public function getCrud(): string
    {
        return $this->crud;
    }
}
