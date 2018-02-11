<?php

namespace Lfbn\BaseModel;

interface IConverter
{
    public function fromCamelCaseToSnakeCase(string $value);

    public function fromObjectToArray($object);

    public function fromObjectToJson($object);
}
