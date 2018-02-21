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
     * @dataProvider notTrueProvider
     */
    public function testIfIsTrueFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isTrue($input)
        );
    }

    /**
     * @param boolean $input
     * @dataProvider trueProvider
     */
    public function testIfIsTrueSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notFalseProvider
     */
    public function testIfIsFalseFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isFalse($input)
        );
    }

    /**
     * @param boolean $input
     * @dataProvider falseProvider
     */
    public function testIfIsFalseSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isFalse($input)
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
     * @param mixed $input
     * @dataProvider notNullProvider
     */
    public function testIfIsNotNullSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNotNull($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notArrayProvider
     */
    public function testIfIsArrayFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isArray($input)
        );
    }

    /**
     * @param array $input
     * @dataProvider arrayProvider
     */
    public function testIfIsArraySucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isArray($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider notEmailProvider
     */
    public function testIfIsEmailFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isEmail($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider emailProvider
     */
    public function testIfIsEmailSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isEmail($input)
        );
    }

    /**
     * PROVIDERS
     */

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
    public function numericProvider()
    {
        return [
            'Integer' => [1],
            'Float' => [6.3],
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

    public function integerProvider()
    {
        return [
            'Integer' => [6]
        ];
    }

    public function notIntegerProvider()
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function floatProvider()
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function notFloatProvider()
    {
        return [
            'Integer' => [6]
        ];
    }

    public function stringProvider()
    {
        return [
            'String' => ['test']
        ];
    }

    public function notStringProvider()
    {
        return [
            'Integer' => [6],
            'Object' => [new \stdClass()]
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

    public function notBooleanProvider()
    {
        return [
            'Integer' => [6],
            'String' => ['test']
        ];
    }

    public function trueProvider()
    {
        return [
            'String number one' => ['1'],
            'Number one' => [1],
            'True' => [true]
        ];
    }

    public function notTrueProvider()
    {
        return [
            'String false' => ['false'],
            'String number one' => ['0'],
            'Number zero' => [0],
            'False' => [false],
            'Null' => [null]
        ];
    }

    public function falseProvider()
    {
        return [
            'String number zero' => ['0'],
            'Number zero' => [0],
            'False' => [false],
            'Null' => [null]
        ];
    }

    public function notFalseProvider()
    {
        return [
            'String number one' => ['1'],
            'Number one' => [1],
            'True' => [true]
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

    public function arrayProvider()
    {
        return [
            'Array' => [array()],
            'Array brackets' => [[]],
            'Associative array' => [array('teste' => 1)]
        ];
    }

    public function notArrayProvider()
    {
        return [
            'String' => [''],
            'Number' => [1],
            'Boolean' => [true]
        ];
    }

    public function emailProvider()
    {
        return [
            'Valid e-mail' => ['test@test.com'],
            'Valid e-mail with several dots' => ['test.test.test@test.com'],
            'Valid e-mail with plus sign' => ['test+test@test.com'],
            'Valid e-mail with underscore' => ['test_test@test.com']
        ];
    }

    public function notEmailProvider()
    {
        return [
            'Invalid e-mail without domain' => ['test'],
            'Invalid e-mail with only domain' => ['@test.com'],
            'Invalid e-mail with two at' => ['test@test@.com']
        ];
    }
}
