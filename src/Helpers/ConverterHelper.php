<?php

namespace Lfbn\BaseModel\Helpers;

use Lfbn\BaseModel\IConverter;

class ConverterHelper implements IConverter
{

    public function __construct()
    {
    }

    /**
     * @param string $value
     * @return string
     * @ref https://stackoverflow.com/a/1993772/155905
     */
    public function fromCamelCaseToSnakeCase(string $value): string
    {
        if (empty($value)) {
            return '';
        }

        preg_match_all(
            '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!',
            $value,
            $matches
        );
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * @param mixed $object
     * @param boolean $excludeEmptyProps
     * @return array
     */
    public function fromObjectToArray($object, $excludeEmptyProps = false): array
    {
        if (empty($object) || !\is_object($object)) {
            return [];
        }

        return $this->extractPropertiesFromObject($object, $excludeEmptyProps);
    }

    /**
     * @param mixed $object
     * @param boolean $excludeEmptyProps
     * @return string
     */
    public function fromObjectToJson($object, $excludeEmptyProps = false): string
    {
        if (empty($object) || !\is_object($object)) {
            return '';
        }

        return json_encode($this->extractPropertiesFromObject($object, $excludeEmptyProps));
    }

    /**
     * @param mixed $object
     * @param boolean $excludeEmptyProps
     * @return array
     * @ref https://stackoverflow.com/a/37610076/155905
     */
    private function extractPropertiesFromObject($object, $excludeEmptyProps = false): array
    {
        $result = [];

        $reflector = new \ReflectionObject($object);
        $properties = $reflector->getProperties();
        foreach ($properties as $property) {
            $value = $property->getValue($object);
            if ($excludeEmptyProps && empty($value)) {
                continue;
            }
            $refProperty = $reflector->getProperty($property->getName());
            $refProperty->setAccessible(true);
            $result[$this->fromCamelCaseToSnakeCase($property->getName())] = $property->getValue($object);
        }

        return $result;
    }
}
