<?php

namespace Lfbn\BaseModel\Helpers;

use PHPUnit\Framework\TestCase;

class ValidatorHelperTest extends TestCase
{

    /**
     * @var ValidatorHelper
     */
    protected $validatorHelperMock;

    public function setUp()
    {
        $this->validatorHelperMock = \Mockery::mock(
            ValidatorHelper::class
        )->makePartial();
    }

    /**
     * @param $input
     * @dataProvider emptyValuesProvider
     */
    public function testWhenTheValueIsEmptyShouldNotValidate($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNumeric($input)
        );

        $this->assertTrue(
            $this->validatorHelperMock->isInteger($input)
        );

        $this->assertTrue(
            $this->validatorHelperMock->isFloat($input)
        );

        $this->assertTrue(
            $this->validatorHelperMock->isString($input)
        );

        $this->assertTrue(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider emptyValuesProvider
     */
    public function testIfIsNotEmptyFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNotEmpty($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notEmptyValuesProvider
     */
    public function testIfIsNotEmptySucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNotEmpty($input)
        );
    }

    /**
     * @param integer $input
     * @dataProvider notNumericProvider
     */
    public function testIfIsNumericFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNumeric($input)
        );
    }

    /**
     * @param integer $input
         * @dataProvider numericProvider
     */
    public function testIfIsNumericSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNumeric($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notIntegerProvider
     */
    public function testIfIsIntegerFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isInteger($input)
        );
    }

    /**
     * @param integer $input
     * @dataProvider integerProvider
     */
    public function testIfIsIntegerSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isInteger($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notFloatProvider
     */
    public function testIfIsFloatFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isFloat($input)
        );
    }

    /**
     * @param float $input
     * @dataProvider floatProvider
     */
    public function testIfIsFloatSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isFloat($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notStringProvider
     */
    public function testIfIsStringFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isString($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider stringProvider
     */
    public function testIfIsStringSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isString($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notBooleanProvider
     */
    public function testIfIsBooleanFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param boolean $input
     * @dataProvider booleanProvider
     */
    public function testIfIsBooleanSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notNullProvider
     */
    public function testIfIsNullFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNull($input)
        );
    }

    /**
     * @param null $input
     * @dataProvider nullProvider
     */
    public function testIfIsNullSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNull($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider nullProvider
     */
    public function testIfIsNotNullFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNotNull($input)
        );
    }

    /**
     * @param null $input
     * @dataProvider notNullProvider
     */
    public function testIfIsNotNullSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNotNull($input)
        );
    }

    /**
     * @return array
     */
    public function emptyValuesProvider()
    {
        return [
            'Empty string' => [''],
            'Null' => [null],
            'Empty array' => [[]]
        ];
    }

    /**
     * @return array
     */
    public function notEmptyValuesProvider()
    {
        return [
            'Not empty string' => ['test'],
            'Number' => [1],
            'Float' => [1.2]
        ];
    }

    /**
     * @return array
     */
    public function notNumericProvider()
    {
        return [
            'Not empty string' => ['test'],
            'Object' => [new \stdClass()],
        ];
    }

    /**
     * @return array
     */
    public function numericProvider()
    {
        return [
            'Integer' => [1],
            'Float' => [6.3],
        ];
    }

    public function notIntegerProvider()
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function integerProvider()
    {
        return [
            'Integer' => [6]
        ];
    }

    public function notFloatProvider()
    {
        return [
            'Integer' => [6]
        ];
    }

    public function floatProvider()
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function notStringProvider()
    {
        return [
            'Integer' => [6],
            'Object' => [new \stdClass()]
        ];
    }

    public function stringProvider()
    {
        return [
            'String' => ['test']
        ];
    }

    public function notBooleanProvider()
    {
        return [
            'Integer' => [6],
            'String' => ['test']
        ];
    }

    public function booleanProvider()
    {
        return [
            'String true' => ['true'],
            'String number one' => ['1'],
            'String number zero' => ['0'],
            'Number one' => [1],
            'Number zero' => [0],
            'String false' => ['false'],
            'True' => [true],
            'False' => [false]
        ];
    }

    public function nullProvider()
    {
        return [
            'Null' => [null]
        ];
    }

    public function notNullProvider()
    {
        return [
            'Array' => [array()],
            'String' => [''],
            'Integer' => [123]
        ];
    }
}
