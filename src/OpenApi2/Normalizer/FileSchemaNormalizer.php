<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Jane\OpenApi2\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FileSchemaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Jane\\OpenApi2\\Model\\FileSchema';
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Jane\OpenApi2\Model\FileSchema;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['document-origin']);
        }
        $object = new \Jane\OpenApi2\Model\FileSchema();
        $data = clone $data;
        if (property_exists($data, 'format')) {
            $object->setFormat($data->{'format'});
            unset($data->{'format'});
        }
        if (property_exists($data, 'title')) {
            $object->setTitle($data->{'title'});
            unset($data->{'title'});
        }
        if (property_exists($data, 'description')) {
            $object->setDescription($data->{'description'});
            unset($data->{'description'});
        }
        if (property_exists($data, 'default')) {
            $object->setDefault($data->{'default'});
            unset($data->{'default'});
        }
        if (property_exists($data, 'required')) {
            $values = [];
            foreach ($data->{'required'} as $value) {
                $values[] = $value;
            }
            $object->setRequired($values);
            unset($data->{'required'});
        }
        if (property_exists($data, 'type')) {
            $object->setType($data->{'type'});
            unset($data->{'type'});
        }
        if (property_exists($data, 'readOnly')) {
            $object->setReadOnly($data->{'readOnly'});
            unset($data->{'readOnly'});
        }
        if (property_exists($data, 'externalDocs')) {
            $object->setExternalDocs($this->denormalizer->denormalize($data->{'externalDocs'}, 'Jane\\OpenApi2\\Model\\ExternalDocs', 'json', $context));
            unset($data->{'externalDocs'});
        }
        if (property_exists($data, 'example')) {
            $object->setExample($data->{'example'});
            unset($data->{'example'});
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/^x-/', $key)) {
                $object[$key] = $value_1;
            }
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getFormat()) {
            $data->{'format'} = $object->getFormat();
        }
        if (null !== $object->getTitle()) {
            $data->{'title'} = $object->getTitle();
        }
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }
        if (null !== $object->getDefault()) {
            $data->{'default'} = $object->getDefault();
        }
        if (null !== $object->getRequired()) {
            $values = [];
            foreach ($object->getRequired() as $value) {
                $values[] = $value;
            }
            $data->{'required'} = $values;
        }
        if (null !== $object->getType()) {
            $data->{'type'} = $object->getType();
        }
        if (null !== $object->getReadOnly()) {
            $data->{'readOnly'} = $object->getReadOnly();
        }
        if (null !== $object->getExternalDocs()) {
            $data->{'externalDocs'} = $this->normalizer->normalize($object->getExternalDocs(), 'json', $context);
        }
        if (null !== $object->getExample()) {
            $data->{'example'} = $object->getExample();
        }
        foreach ($object as $key => $value_1) {
            if (preg_match('/^x-/', $key)) {
                $data->{$key} = $value_1;
            }
        }

        return $data;
    }
}