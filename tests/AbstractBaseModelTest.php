<?php

namespace Lfbn\BaseModel\Tests;

use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;
use Lfbn\BaseModel\Helpers\ValidatorHelper;
use Lfbn\BaseModel\IConverter;
use Lfbn\BaseModel\Tests\Mocks\UserModelMock;

class AbstractBaseModelTest extends TestCase
{

    /**
     * @var UserModelMock
     */
    protected $userMock;

    public function setUp()
    {
        $this->userMock = \Mockery::mock(
            UserModelMock::class
        )->makePartial();
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testIsValidatingShouldDefaultsToTrue(): void
    {
        $this->assertTrue(
            $this->userMock->isValidating()
        );
    }

    public function testShouldAllowToDefineIfIsValidating(): void
    {
        $this->userMock->setIsValidating(false);
        $this->assertFalse($this->userMock->isValidating());
    }

    public function testShouldWhenNotValidatingAtValidateReturnEmptyArray(): void
    {
        $this->userMock->setIsValidating(false);
        $this->assertEquals(
            [],
            $this->userMock->validate()
        );
    }

    public function testShouldWhenValidatingReturnEmptyArrayWhenAllPropsAreValid(): void
    {
        $validator = \Mockery::mock(ValidatorHelper::class);
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

    public function testShouldWhenValidatingReturnErrorsWhenExistsInvalidProps(): void
    {
        $validator = \Mockery::mock(ValidatorHelper::class);
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

    public function testShouldWhenValidatingNotToThrowExceptionsByDefault(): void
    {
        $this->assertFalse(
            $this->userMock->isValidatingThrowingExceptions()
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testShouldAllowWhenValidatingToThrowExceptionsWhenValidatingFails(): void
    {
        $validator = \Mockery::mock(ValidatorHelper::class);
        $validator->shouldReceive('isInteger')->andReturn(false);
        $this->userMock->setValidator($validator);

        $this->userMock->setData(['id' => 'test-fail']);
        $this->userMock->shouldReceive('getValidationRules')->andReturn(
            [['property' => 'id', 'validator' => 'isInteger']]
        );
        $this->userMock->setValidatingThrowingExceptions(true);
        $this->userMock->validate();
    }

    public function testShouldBePossibleToPopulateData(): void
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
    public function testShouldValidateDataWhenBeingPopulated($expected): void
    {
        $this->expectException($this->userMock->setData($expected));
    }

    public function testShouldConvertToArray(): void
    {
        $converterMock = \Mockery::mock(
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

    public function testShouldConvertToJson(): void
    {
        $converterMock = \Mockery::mock(
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
    public function invalidValuesProvider(): array
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
