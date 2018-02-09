<?php

use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;
use Lfbn\BaseModel\AbstractBaseModel;
use Lfbn\BaseModel\IConverter;
use Lfbn\BaseModel\Helpers\ValidatorHelper;

class BaseModelTest extends TestCase
{

    /**
     * @var AbstractBaseModel
     */
    protected $baseModelMock;

    public function setUp()
    {
        $this->baseModelMock = Mockery::mock(
            AbstractBaseModel::class
        )->makePartial();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testValidatingDefaultsToTrue()
    {
        $this->assertTrue(
            $this->baseModelMock->isValidating()
        );
    }

    public function testValidatingSet()
    {
        $this->baseModelMock->setValidating(false);
        $this->assertFalse($this->baseModelMock->isValidating());
    }

    public function testNotValidatingValidateReturnsFalse()
    {
        $this->baseModelMock->setValidating(false);
        $this->assertFalse($this->baseModelMock->validate());
    }

    public function testValidatingThrowingExceptionsDefaultsToFalse()
    {
        $this->assertFalse(
            $this->baseModelMock->isValidatingThrowingExceptions()
        );
    }

    public function testValidatingThrowingExceptionsSet()
    {
        $this->baseModelMock->setValidatingThrowingExceptions(true);
        $this->assertTrue(
            $this->baseModelMock->isValidatingThrowingExceptions()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testValidateThrowingExceptionsWhenFailedValidation()
    {
        $validator = Mockery::Mock(ValidatorHelper::class);
        $validator->shouldReceive('isInteger')->andReturn(false);
        $this->baseModelMock->setValidator($validator);

        $this->baseModelMock->setData(['id' => 'test-fail']);
        $this->baseModelMock->shouldReceive('getValidationRules')->andReturn(
            [['property' => 'id', 'validator' => 'isInteger']]
        );
        $this->baseModelMock->setValidatingThrowingExceptions(true);
        $this->baseModelMock->validate();
    }

    /**
     * @param array $expected
     * @expectedException Error
     * @dataProvider setDataInvalidValuesProvider
     */
    public function testSetDataValidateData($expected)
    {
        $this->expectException($this->baseModelMock->setData($expected));
    }

    public function testSetData()
    {
        $this->baseModelMock->setData(['teste' => 1]);
        $this->assertEquals(
            $this->baseModelMock->teste,
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
        $this->baseModelMock->setConverter($converterMock);
        $this->assertEquals(
            $this->baseModelMock->toArray(),
            ['test' => 1]
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
