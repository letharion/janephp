<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Jane\JsonSchema\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers = [];
        $normalizers[] = new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer();
        $normalizers[] = new \Jane\JsonSchemaRuntime\Normalizer\ReferenceNormalizer();
        $normalizers[] = new ListNormalizer();

        return $normalizers;
    }
}
