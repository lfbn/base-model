<?php

namespace Lfbn\BaseModel\Helpers;

use Lfbn\BaseModel\IValidator;

class ValidatorHelper implements IValidator
{

    public function __construct()
    {
    }

    /**
     * @param $value
     * @return bool
     */
    public function isNotEmpty($value)
    {
        if (empty($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $value
     * @return boolean
     */
    public function isNumeric($value)
    {
        if (empty($value)) {
            return true;
        }

        if (!is_numeric($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $value
     * @return boolean
     */
    public function isInteger($value)
    {
        if (empty($value)) {
            return true;
        }

        if (!is_integer($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param float $value
     * @return boolean
     */
    public function isFloat($value)
    {
        if (empty($value)) {
            return true;
        }

        if (!is_float($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $value
     * @return boolean
     */
    public function isString($value)
    {
        if (empty($value)) {
            return true;
        }

        if (!is_string($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param boolean $value
     * @return boolean
     */
    public function isBoolean($value)
    {

        if (empty($value)) {
            return true;
        }

        if (in_array(
            $value,
            [0, 1],
            true
        )) {
            return true;
        }

        if (in_array(
            $value,
            ["0", "1", "true", "false"],
            true
        )) {
            return true;
        }

        if (!is_bool($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param boolean $value
     * @return bool
     */
    public function isTrue($value)
    {
        if (true === $value ||
            1 === $value ||
            '1' === $value
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param boolean $value
     * @return bool
     */
    public function isFalse($value)
    {
        if (null === $value ||
            false === $value ||
            0 === $value ||
            '0' === $value
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param null $value
     * @return boolean
     */
    public function isNull($value)
    {
        if ($value === null) {
            return true;
        }

        return false;
    }

    /**
     * @param null $value
     * @return boolean
     */
    public function isNotNull($value)
    {
        if ($value !== null) {
            return true;
        }

        return false;
    }

    /**
     * @param array $value
     * @return boolean
     */
    public function isArray($value)
    {
        if (is_array($value)) {
            return true;
        }

        return false;
    }
}
