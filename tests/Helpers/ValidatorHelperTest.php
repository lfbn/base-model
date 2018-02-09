<?php

use PHPUnit\Framework\TestCase;
use Lfbn\BaseModel\Helpers\ValidatorHelper;

class ValidatorHelperTest extends TestCase
{

    /**
     * @var ValidatorHelper
     */
    protected $validatorHelperMock;

    public function setUp()
    {
        $this->validatorHelperMock = Mockery::mock(
            ValidatorHelper::class
        )->makePartial();
    }

    /**
     * @param $input
     * @dataProvider emptyValuesProvider
     */
    public function testIfEmptyValueExceptNotEmptyShouldNotValidate($input)
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
    public function testIsNotEmptyFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNotEmpty($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isNotEmptySucceedsProvider
     */
    public function testIsNotEmptySucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNotEmpty($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isNumericFailsProvider
     */
    public function testIsNumericFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNumeric($input)
        );
    }

    /**
     * @param mixed $input
         * @dataProvider isNumericSucceedsProvider
     */
    public function testIsNumericSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNumeric($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isIntegerFailsProvider
     */
    public function testIsIntegerFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isInteger($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isIntegerSucceedsProvider
     */
    public function testIsIntegerSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isInteger($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isFloatFailsProvider
     */
    public function testIsFloatFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isFloat($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isFloatSucceedsProvider
     */
    public function testIsFloatSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isFloat($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isStringFailsProvider
     */
    public function testIsStringFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isString($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isStringSucceedsProvider
     */
    public function testIsStringSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isString($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isBooleanFailsProvider
     */
    public function testIsBooleanFails($input)
    {
        $this->assertFalse(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider isBooleanSucceedsProvider
     */
    public function testIsBooleanSucceeds($input)
    {
        $this->assertTrue(
            $this->validatorHelperMock->isBoolean($input)
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
    public function isNotEmptySucceedsProvider()
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
    public function isNumericFailsProvider()
    {
        return [
            'Not empty string' => ['test'],
            'Object' => [new stdClass()],
        ];
    }

    /**
     * @return array
     */
    public function isNumericSucceedsProvider()
    {
        return [
            'Integer' => [1],
            'Float' => [6.3],
        ];
    }

    public function isIntegerFailsProvider()
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function isIntegerSucceedsProvider()
    {
        return [
            'Integer' => [6]
        ];
    }

    public function isFloatFailsProvider()
    {
        return [
            'Integer' => [6]
        ];
    }

    public function isFloatSucceedsProvider()
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function isStringFailsProvider()
    {
        return [
            'Integer' => [6],
            'Object' => [new stdClass()]
        ];
    }

    public function isStringSucceedsProvider()
    {
        return [
            'String' => ['test']
        ];
    }

    public function isBooleanFailsProvider()
    {
        return [
            'Integer' => [6],
            'String' => ['test']
        ];
    }

    public function isBooleanSucceedsProvider()
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
}
