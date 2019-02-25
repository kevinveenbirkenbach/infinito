<?php

namespace Infinito\Attribut;

use Infinito\Exception\NoValidChoiceException;
use Infinito\DBAL\Types\Meta\Right\CRUDType;

/**
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
        if (!in_array($crud, CRUDType::getValues())) {
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
