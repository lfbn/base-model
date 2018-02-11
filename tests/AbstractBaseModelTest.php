<?php

use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;
use Lfbn\BaseModel\AbstractBaseModel;
use Lfbn\BaseModel\IConverter;
use Lfbn\BaseModel\Helpers\ValidatorHelper;

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

class BaseModelTest extends TestCase
{

    /**
     * @var User
     */
    protected $userMock;

    public function setUp()
    {
        $this->userMock = Mockery::mock(
            User::class
        )->makePartial();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testValidatingDefaultsToTrue()
    {
        $this->assertTrue(
            $this->userMock->isValidating()
        );
    }

    public function testValidatingSet()
    {
        $this->userMock->setValidating(false);
        $this->assertFalse($this->userMock->isValidating());
    }

    public function testNotValidatingValidateReturnsFalse()
    {
        $this->userMock->setValidating(false);
        $this->assertFalse($this->userMock->validate());
    }

    public function testValidatingThrowingExceptionsDefaultsToFalse()
    {
        $this->assertFalse(
            $this->userMock->isValidatingThrowingExceptions()
        );
    }

    public function testValidatingThrowingExceptionsSet()
    {
        $this->userMock->setValidatingThrowingExceptions(true);
        $this->assertTrue(
            $this->userMock->isValidatingThrowingExceptions()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidateThrowingExceptionsWhenFailedValidation()
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

    /**
     * @param array $expected
     * @expectedException Error
     * @dataProvider setDataInvalidValuesProvider
     */
    public function testSetDataValidateData($expected)
    {
        $this->expectException($this->userMock->setData($expected));
    }

    public function testSetData()
    {
        $this->userMock->setData(['teste' => 1]);
        $this->assertEquals(
            $this->userMock->teste,
            1
        );
    }

    public function testToArray()
    {
        $converterMock = Mockery::mock(
            IConverter::class
        );
        $converterMock
            ->shouldReceive('fromObjectToArray')
            ->andReturn(['test' => 1]);
        $this->userMock->setConverter($converterMock);
        $this->assertEquals(
            $this->userMock->toArray(),
            ['test' => 1]
        );
    }

    public function testToJson()
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
    public function setDataInvalidValuesProvider()
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
