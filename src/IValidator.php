<?php

namespace Lfbn\BaseModel;

interface IValidator
{

    public function isNotEmpty($value);

    public function isNumeric($value);

    public function isInteger($value);

    public function isFloat($value);

    public function isString($value);

    public function isBoolean($value);

    public function isNull($value);

    public function isNotNull($value);
}
