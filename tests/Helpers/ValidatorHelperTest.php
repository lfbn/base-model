<?php

namespace Lfbn\BaseModel\Tests\Helpers;

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
        $this->validatorHelperMock = \Mockery::mock(
            ValidatorHelper::class
        )->makePartial();
    }

    /**
     * @param mixed $input
     * @dataProvider emptyValuesProvider
     */
    public function testWhenTheValueIsEmptyShouldNotValidate($input): void
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
    public function testIfIsNotEmptyFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNotEmpty($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notEmptyValuesProvider
     */
    public function testIfIsNotEmptySucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNotEmpty($input)
        );
    }

    /**
     * @param integer $input
     * @dataProvider notNumericProvider
     */
    public function testIfIsNumericFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNumeric($input)
        );
    }

    /**
     * @param integer $input
     * @dataProvider numericProvider
     */
    public function testIfIsNumericSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNumeric($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notIntegerProvider
     */
    public function testIfIsIntegerFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isInteger($input)
        );
    }

    /**
     * @param integer $input
     * @dataProvider integerProvider
     */
    public function testIfIsIntegerSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isInteger($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notFloatProvider
     */
    public function testIfIsFloatFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isFloat($input)
        );
    }

    /**
     * @param float $input
     * @dataProvider floatProvider
     */
    public function testIfIsFloatSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isFloat($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notStringProvider
     */
    public function testIfIsStringFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isString($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider stringProvider
     */
    public function testIfIsStringSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isString($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notBooleanProvider
     */
    public function testIfIsBooleanFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param boolean $input
     * @dataProvider booleanProvider
     */
    public function testIfIsBooleanSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isBoolean($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notTrueProvider
     */
    public function testIfIsTrueFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isTrue($input)
        );
    }

    /**
     * @param boolean $input
     * @dataProvider trueProvider
     */
    public function testIfIsTrueSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isTrue($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notFalseProvider
     */
    public function testIfIsFalseFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isFalse($input)
        );
    }

    /**
     * @param boolean $input
     * @dataProvider falseProvider
     */
    public function testIfIsFalseSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isFalse($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notNullProvider
     */
    public function testIfIsNullFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNull($input)
        );
    }

    /**
     * @param null $input
     * @dataProvider nullProvider
     */
    public function testIfIsNullSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNull($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider nullProvider
     */
    public function testIfIsNotNullFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isNotNull($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notNullProvider
     */
    public function testIfIsNotNullSucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isNotNull($input)
        );
    }

    /**
     * @param mixed $input
     * @dataProvider notArrayProvider
     */
    public function testIfIsArrayFails($input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isArray($input)
        );
    }

    /**
     * @param array $input
     * @dataProvider arrayProvider
     */
    public function testIfIsArraySucceeds($input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isArray($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider notEmailProvider
     */
    public function testIfIsEmailFails(string $input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isEmail($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider emailProvider
     */
    public function testIfIsEmailSucceeds(string $input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isEmail($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider notUrlProvider
     */
    public function testIfIsUrlFails(string $input): void
    {
        $this->assertFalse(
            $this->validatorHelperMock->isUrl($input)
        );
    }

    /**
     * @param string $input
     * @dataProvider urlProvider
     */
    public function testIfIsUrlSucceeds(string $input): void
    {
        $this->assertTrue(
            $this->validatorHelperMock->isUrl($input)
        );
    }

    /**
     * PROVIDERS
     */

    /**
     * @return array
     */
    public function emptyValuesProvider(): array
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
    public function notEmptyValuesProvider(): array
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
    public function numericProvider(): array
    {
        return [
            'Integer' => [1],
            'Float' => [6.3],
        ];
    }

    /**
     * @return array
     */
    public function notNumericProvider(): array
    {
        return [
            'Not empty string' => ['test'],
            'Object' => [new \stdClass()],
        ];
    }

    public function integerProvider(): array
    {
        return [
            'Integer' => [6]
        ];
    }

    public function notIntegerProvider(): array
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function floatProvider(): array
    {
        return [
            'Float' => [6.5]
        ];
    }

    public function notFloatProvider(): array
    {
        return [
            'Integer' => [6]
        ];
    }

    public function stringProvider(): array
    {
        return [
            'String' => ['test']
        ];
    }

    public function notStringProvider(): array
    {
        return [
            'Integer' => [6],
            'Object' => [new \stdClass()]
        ];
    }

    public function booleanProvider(): array
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

    public function notBooleanProvider(): array
    {
        return [
            'Integer' => [6],
            'String' => ['test']
        ];
    }

    public function trueProvider(): array
    {
        return [
            'String number one' => ['1'],
            'Number one' => [1],
            'True' => [true]
        ];
    }

    public function notTrueProvider(): array
    {
        return [
            'String number zero' => ['0'],
            'Number zero' => [0],
            'False' => [false]
        ];
    }

    public function falseProvider(): array
    {
        return [
            'String number zero' => ['0'],
            'Number zero' => [0],
            'False' => [false]
        ];
    }

    public function notFalseProvider(): array
    {
        return [
            'String number one' => ['1'],
            'Number one' => [1],
            'True' => [true]
        ];
    }

    public function nullProvider(): array
    {
        return [
            'Null' => [null]
        ];
    }

    public function notNullProvider(): array
    {
        return [
            'Array' => [array()],
            'String' => [''],
            'Integer' => [123]
        ];
    }

    public function arrayProvider(): array
    {
        return [
            'Array' => [array()],
            'Array brackets' => [[]],
            'Associative array' => [array('teste' => 1)]
        ];
    }

    public function notArrayProvider(): array
    {
        return [
            'String' => [''],
            'Number' => [1],
            'Boolean' => [true]
        ];
    }

    public function emailProvider(): array
    {
        return [
            'Valid e-mail' => ['test@test.com'],
            'Valid e-mail with several dots' => ['test.test.test@test.com'],
            'Valid e-mail with plus sign' => ['test+test@test.com'],
            'Valid e-mail with underscore' => ['test_test@test.com']
        ];
    }

    public function notEmailProvider(): array
    {
        return [
            'Invalid e-mail without domain' => ['test'],
            'Invalid e-mail with only domain' => ['@test.com'],
            'Invalid e-mail with two at' => ['test@test@.com']
        ];
    }

    public function urlProvider(): array
    {
        return [
            'Valid URL' => ['http://www.google.com'],
            'Valid URL with sub-domain' => ['http://test.google.com'],
            'Valid URL with dashes' => ['http://test-google.com'],
            'Valid URL with folders' => ['http://test.google.com/test']
        ];
    }

    public function notUrlProvider(): array
    {
        return [
            'Invalid URL with colon' => ['www::google.com'],
            'Invalid URL with underscores' => ['__test.google.com'],
            'Invalid URL with pipe' => ['http://test|google.com/test'],
            'Invalid URL with no $' => ['test$$$google.com']
        ];
    }
}
