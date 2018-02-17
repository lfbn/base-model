# About Base Model

- [Features](#features)
- [Installation](#installation)
- [Examples](#examples)

This is a Base Model that can be extended to define Models. It helps handling data validation, and data conversion.

## Features
 
* Validation of properties. All, except the isNotEmpty, doesn't validate the data if it is empty. The following validator are available:
  * isNotEmpty
  * isNumeric
  * isInteger
  * isFloat
  * isString
  * isBoolean
* Model to array and JSON, preserving hidden attributes.
* Define attributes using arrays of data.
* Can define, when validation fails, if an exception is thrown.
* Can define if data should be validated or not.

## Installation

```bash
composer require lfbn/base-model
```

## Examples

### How to use it

Define your model extending the AbstractBaseModel, then implement a public method getValidationRules. This method should define the properties you want to validate.

Here is an example:

```php
class User extends AbstractBaseModel
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return array
     */
    public function getValidationRules()
    {
        return [
            ['property' => 'id', 'validator' => 'isNotEmpty'],
            ['property' => 'id', 'validator' => 'isInteger'],
            ['property' => 'height', 'validator' => 'isFloat'],
            ['property' => 'active', 'validator' => 'isBoolean']
        ];
    }
}
```

## How to know if is valid?

You need to call the `validate()` method

```php
$user = new User();
$user->validate();
```

## Can I use my own validator?

Yes. It only needs to implement the interface IValidator.

```php
$user = new User();
$myValidator = new MyValidator();
$user->setValidator($myValidator);
```

## Can I use my own converter?

Yes. It only needs to implement the interface IConverter.

```php
$user = new User();
$myConverter = new MyConverter();
$user->setConverter($myConverter);
```

## About

### Requirements

- Base Model works with PHP 7 or above.

### Running Tests

You can run the tests executing the following command. Before you can run these, be sure to run `composer install`.

```bash
composer test
```

### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/lfbn/base-model/issues)

### License

Base Model is licensed under the MIT License - see the `LICENSE` file for details