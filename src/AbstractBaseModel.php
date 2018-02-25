<?php

namespace Lfbn\BaseModel;

use Lfbn\BaseModel\Helpers\ConverterHelper;
use Lfbn\BaseModel\Helpers\ValidatorHelper;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

abstract class AbstractBaseModel
{

    /**
     * @var bool
     */
    private $isValidating = true;

    /**
     * @var bool
     */
    private $validatingThrowingExceptions = false;

    /**
     * @var IConverter
     */
    private $converter;

    /**
     * @var IValidator
     */
    private $validator;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private static $errorMessages = [
        'isBoolean' => 'The value (%s) of %s should be boolean.',
        'isString' => 'The value (%s) of %s should be string.',
        'isFloat' => 'The value (%s) of %s should be float.',
        'isInteger' => 'The value (%s) of %s should be integer.',
        'isNumeric' => 'The value (%s) of %s should be numeric.',
        'isNotEmpty' => 'The value (%s) of %s shouldn\'t be empty.'
    ];

    /**
     * @param IConverter $converter
     * @param IValidator $validator
     */
    public function __construct(
        IConverter $converter = null,
        IValidator $validator = null
    ) {

        if (null === $converter) {
            $this->converter = new ConverterHelper();
        } else {
            $this->converter = $converter;
        }

        if (null === $validator) {
            $this->validator = new ValidatorHelper();
        } else {
            $this->validator = $validator;
        }
    }

    /**
     * Defines the properties and rules to be validated.
     *
     * @return array Should be in the following format: [['property' => 'id', 'validator' => 'isInteger' ]]
     */
    abstract public function getValidationRules(): array;

    /**
     * @throws \InvalidArgumentException
     * @return array
     */
    public function validate(): array
    {
        if (!$this->isValidating) {
            return [];
        }

        foreach ($this->getValidationRules() as $rule) {
            if (!$this->validator->{$rule['validator']}($this->{$rule['property']})) {
                if (isset(self::$errorMessages[$rule['validator']])) {
                    $message = sprintf(
                        self::$errorMessages[$rule['validator']],
                        $this->{$rule['property']},
                        $rule['property']
                    );
                } else {
                    $message = "The {$rule['validator']} for the property {$rule['property']} failed";
                }
                if ($this->validatingThrowingExceptions) {
                    throw new \InvalidArgumentException(
                        'Base Model: ' . $message
                    );
                }
                $this->errors[] = $message;
            }
        }
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function isValidating(): bool
    {
        return $this->isValidating;
    }

    /**
     * @param bool $value
     */
    public function setIsValidating(bool $value): void
    {
        $this->isValidating = $value;
    }

    /**
     * @return bool
     */
    public function isValidatingThrowingExceptions(): bool
    {
        return $this->validatingThrowingExceptions;
    }

    /**
     * @param bool $validatingThrowingExceptions
     */
    public function setValidatingThrowingExceptions(bool $validatingThrowingExceptions): void
    {
        $this->validatingThrowingExceptions = $validatingThrowingExceptions;
    }

    /**
     * @param IConverter $converter
     */
    public function setConverter(IConverter $converter): void
    {
        $this->converter = $converter;
    }

    /**
     * @param IValidator $validator
     */
    public function setValidator(IValidator $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function setData(array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->converter->fromObjectToArray($this);
    }

    /**
     * @return array
     */
    public function toArrayWithNoEmptyProperties(): array
    {
        return $this->converter->fromObjectToArray($this, true);
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return $this->converter->fromObjectToJson($this);
    }
}
