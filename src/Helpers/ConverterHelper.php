<?php

namespace Lfbn\BaseModel\Helpers;

use Lfbn\BaseModel\IConverter;

class ConverterHelper implements IConverter
{

    public function _construct()
    {}

    /**
     * @param string $value
     * @return string string
     * @ref https://stackoverflow.com/a/1993772/155905
     */
    public function fromCamelCaseToSnakeCase(string $value)
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
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * @param $object
     * @return array
     * @ref https://stackoverflow.com/a/37610076/155905
     */
    public function fromObjectToArray($object)
    {
        if (empty($object) || !is_object($object)) {
            return [];
        }

        $result = [];

        $reflector = new \ReflectionObject($object);
        $nodes = $reflector->getProperties();
        foreach ($nodes as  $node) {
            $nod=$reflector->getProperty($node->getName());
            $nod->setAccessible(true);
            $result[self::fromCamelCaseToSnakeCase($node->getName())]=$nod->getValue($object);
        }

        return $result;
    }
}
