<?php

use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;
use Lfbn\BaseModel\AbstractBaseModel;
use Lfbn\BaseModel\IConverter;
use Lfbn\BaseModel\Helpers\ValidatorHelper;

class ModelUser extends AbstractBaseModel
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
            ['property' => 'name', 'validator' => 'isString'],
            ['property' => 'height', 'validator' => 'isFloat'],
            ['property' => 'active', 'validator' => 'isBoolean']
        ];
    }
}

class BaseModelTest extends TestCase
{

    /**
     * @var User
     */
    protected $userMock;

    public function setUp()
    {
        $this->userMock = Mockery::mock(
            ModelUser::class
        )->makePartial();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testIsValidatingShouldDefaultsToTrue()
    {
        $this->assertTrue(
            $this->userMock->isValidating()
        );
    }

    public function testShouldAllowToDefineIfIsValidating()
    {
        $this->userMock->setIsValidating(false);
        $this->assertFalse($this->userMock->isValidating());
    }

    public function testShouldWhenNotValidatingAtValidateReturnEmptyArray()
    {
        $this->userMock->setIsValidating(false);
        $this->assertEquals(
            [],
            $this->userMock->validate()
        );
    }

    public function testShouldWhenValidatingReturnEmptyArrayWhenAllPropsAreValid()
    {
        $validator = Mockery::Mock(ValidatorHelper::class);
        $validator->shouldReceive([
            'isNotEmpty' => true,
            'isInteger' => true,
            'isString' => true,
            'isFloat' => true,
            'isBoolean' => true,
        ]);
        $this->userMock->setValidator($validator);
        $this->assertEquals(
            [],
            $this->userMock->validate()
        );
    }

    public function testShouldWhenValidatingReturnErrorsWhenExistsInvalidProps()
    {
        $validator = Mockery::Mock(ValidatorHelper::class);
        $validator->shouldReceive([
            'isNotEmpty' => false,
            'isInteger' => true,
            'isString' => false,
            'isFloat' => true,
            'isBoolean' => true,
        ]);
        $this->userMock->setValidator($validator);
        $this->assertEquals(
            [
                "The value () of id shouldn't be empty.",
                "The value () of name should be string."
            ],
            $this->userMock->validate()
        );
    }

    public function testShouldWhenValidatingNotToThrowExceptionsByDefault()
    {
        $this->assertFalse(
            $this->userMock->isValidatingThrowingExceptions()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldAllowWhenValidatingToThrowExceptionsWhenValidatingFails()
    {
        $validator = Mockery::Mock(ValidatorHelper::class);
        $validator->shouldReceive('isInteger')->andReturn(false);
        $this->userMock->setValidator($validator);

        $this->userMock->setData(['id' => 'test-fail']);
        $this->userMock->shouldReceive('getValidationRules')->andReturn(
            [['property' => 'id', 'validator' => 'isInteger']]
        );
        $this->userMock->setValidatingThrowingExceptions(true);
        $this->userMock->validate();
    }

    public function testShouldBePossibleToPopulateData()
    {
        $this->userMock->setData(['id' => 1]);
        $this->assertEquals(
            1,
            $this->userMock->getId()
        );
    }

    /**
     * @param array $expected
     * @expectedException Error
     * @dataProvider invalidValuesProvider
     */
    public function testShouldValidateDataWhenBeingPopulated($expected)
    {
        $this->expectException($this->userMock->setData($expected));
    }

    public function testShouldConvertToArray()
    {
        $converterMock = Mockery::mock(
            IConverter::class
        );
        $converterMock
            ->shouldReceive('fromObjectToArray')
            ->andReturn(['test' => 1]);
        $this->userMock->setConverter($converterMock);
        $this->assertEquals(
            ['test' => 1],
            $this->userMock->toArray()
        );
    }

    public function testShouldConvertToJson()
    {
        $converterMock = Mockery::mock(
            IConverter::class
        );
        $converterMock
            ->shouldReceive('fromObjectToJson')
            ->andReturn('{"test":1}');
        $this->userMock->setConverter($converterMock);
        $this->assertEquals(
            '{"test":1}',
            $this->userMock->toJson()
        );
    }

    /**
     * @return array
     */
    public function invalidValuesProvider()
    {
        return [
            [
                null,
                '',
                false,
                2,
                'test'
            ]
        ];
    }
}
