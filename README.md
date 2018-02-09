# Base Model

This is a Base Model that can be extended to define Models.

 # Features
 
 * Validation of properties. All, except the isNotEmpty, doesn't validate the data if it is empty. Are available the following validators:
   * isNotEmpty
   * isNumeric
   * isInteger
   * isFloat
   * isString
   * isBoolean
 * Model to array conversion, preserving hidden attributes.
 * Define attributes using arrays of data.
 * Can define, when validation fails, if an exception is thrown.
 * Can define if data should be validated or not.

# Installation



# Examples

## How to use it

You only need to extend the AbstractBaseModel and implement a public method getValidationRules. This method should return an array in the following format: ```['property' => 'id', 'validator' => 'isNotEmpty']```

```
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

## How to know if is valid

You only need to call the ```validate()``` method

```
$user = new User();
$user->validate();
```

## Can I use my own validator?

Yes. It only needs to implement the interface IValidator.

```
$user = new User();
$myValidator = new MyValidator();
$user->setValidator($myValidator);
```

## Can I use my own converter?

Yes. It only needs to implement the interface IConverter.

```
$user = new User();
$myConverter = new MyConverter();
$user->setConverter($myConverter);
```