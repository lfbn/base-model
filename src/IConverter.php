<?php

namespace Lfbn\BaseModel;

interface IConverter
{
    public function fromCamelCaseToSnakeCase(string $value);

    public function fromObjectToArray($object, $excludeEmptyProps = false);

    public function fromObjectToJson($object, $excludeEmptyProps = false);
}
