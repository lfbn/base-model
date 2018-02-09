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
    private $validating = true;

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
    private $errorMessages;

    /**
     * @param IConverter $converter
     * @param IValidator $validator
     */
    public function __construct(
        IConverter $converter = null,
        IValidator $validator = null
    ) {

        if (is_null($converter)) {
            $this->converter = new ConverterHelper();
        } else {
            $this->converter = $converter;
        }

        if (is_null($validator)) {
            $this->validator = new ValidatorHelper();
        } else {
            $this->validator = $validator;
        }
    }

    /**
     * @return array
     */
    abstract public function getValidationRules();

    /**
     * @return bool
     */
    public function validate()
    {
        if (!$this->validating) {
            return false;
        }

        foreach ($this->getValidationRules() as $rule) {
            if (!$this->validator->{$rule['validator']}($this->{$rule['property']})) {
                $message = "The {$rule['validator']} for the property {$rule['property']} failed";
                if ($this->validatingThrowingExceptions) {
                    throw new \InvalidArgumentException(
                        "BaseModel: " . $message
                    );
                }
                $this->errorMessages[] = $message;
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isValidating(): bool
    {
        return $this->validating;
    }

    /**
     * @param bool $value
     */
    public function setValidating(bool $value)
    {
        $this->validating = $value;
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

    public function setConverter(IConverter $converter)
    {
        $this->converter = $converter;
    }

    public function setValidator(IValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function setData(array $data)
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
    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->converter->fromObjectToArray($this);
    }
}
