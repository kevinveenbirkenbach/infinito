<?php

namespace App\Source\Generator;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @author kevinfrantz
 */
final class SerializeGenerator extends AbstractGenerator
{
    const SERIALIZABLE_FORMATS = [
        'xml',
        'json',
        'csv',
        'yaml',
    ];

    public function serialize(): string
    {
        $encoders = [new XmlEncoder(), new JsonEncoder(), new YamlEncoder(), new CsvEncoder()];
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(0);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([$normalizer], $encoders);

        return $serializer->serialize($this->source, $this->request->getRequestFormat());
    }
}
