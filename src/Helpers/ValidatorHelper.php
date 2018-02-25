<?php

namespace Lfbn\BaseModel\Helpers;

use Lfbn\BaseModel\IValidator;

class ValidatorHelper implements IValidator
{

    public function __construct()
    {
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isNotEmpty($value): bool
    {
        if (empty($value)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $value
     * @return bool
     */
    public function isNumeric($value): bool
    {
        if (empty($value)) {
            return true;
        }

        return \is_numeric($value);
    }

    /**
     * @param int $value
     * @return bool
     */
    public function isInteger($value): bool
    {
        if (empty($value)) {
            return true;
        }

        return \is_int($value);
    }

    /**
     * @param float $value
     * @return bool
     */
    public function isFloat($value): bool
    {
        if (empty($value)) {
            return true;
        }

        return \is_float($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isString($value): bool
    {
        if (empty($value)) {
            return true;
        }

        return \is_string($value);
    }

    /**
     * @param boolean $value
     * @return bool
     */
    public function isBoolean($value): bool
    {
        if (empty($value)) {
            return true;
        }

        if (\in_array($value, [0, 1], true)) {
            return true;
        }

        if (\in_array($value, ['0', '1', 'true', 'false'], true)) {
            return true;
        }

        return \is_bool($value);
    }

    /**
     * @param boolean $value
     * @return bool
     */
    public function isTrue($value): bool
    {
        if (false === $value || 0 === $value || '0' === $value) {
            return false;
        }

        return true;
    }

    /**
     * @param boolean $value
     * @return bool
     */
    public function isFalse($value): bool
    {
        if (false === $value || 0 === $value || '0' === $value) {
            return true;
        }

        return false;
    }

    /**
     * @param null $value
     * @return bool
     */
    public function isNull($value): bool
    {
        if ($value === null) {
            return true;
        }

        return false;
    }

    /**
     * @param null $value
     * @return bool
     */
    public function isNotNull($value): bool
    {
        if ($value !== null) {
            return true;
        }

        return false;
    }

    /**
     * @param array $value
     * @return bool
     */
    public function isArray($value): bool
    {
        if (\is_array($value)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isEmail(string $value): bool
    {
        if (\filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isUrl(string $value): bool
    {
        if (\filter_var($value, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
    }
}
