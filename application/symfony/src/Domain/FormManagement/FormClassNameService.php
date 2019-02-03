<?php

namespace App\Domain\FormManagement;

/**
 * @author kevinfrantz
 */
final class FormClassNameService implements FormClassNameServiceInterface
{
    /**
     * @var string Folder in which the entities are stored
     */
    const ENTITY_BASE_PATH = 'App\\Entity';

    /**
     * @var string Folder in which the forms are stored
     */
    const FORM_BASE_PATH = 'App\\Form';

    /**
     * @var string Suffix to identifie form classes
     */
    const SUFFIX = 'Type';

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\FormClassNameServiceInterface::getClass()
     */
    public function getClass(string $origineClass, string $type = ''): string
    {
        $replaced = str_replace(self::ENTITY_BASE_PATH, self::FORM_BASE_PATH, $origineClass);
        $withType = $replaced.ucfirst($type);
        $withSuffix = $withType.self::SUFFIX;

        return $withSuffix;
    }
}
