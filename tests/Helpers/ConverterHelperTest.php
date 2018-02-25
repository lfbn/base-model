<?php

namespace Lfbn\BaseModel\Tests\Helpers;

use PHPUnit\Framework\TestCase;
use Lfbn\BaseModel\Helpers\ConverterHelper;

class ConverterHelperTest extends TestCase
{

    /**
     * @var ConverterHelper
     */
    protected $converterHelperDouble;

    public function setUp()
    {
        $this->converterHelperDouble = \Mockery::mock(
            ConverterHelper::class
        )->makePartial();
    }

    /**
     * @param string $input
     * @param string $expectedOutput
     * @dataProvider shouldConvertFromCamelCaseToSnakeCaseProvider
     */
    public function testShouldConvertFromCamelCaseToSnakeCase($input, $expectedOutput): void
    {
        $this->assertEquals(
            $this
                ->converterHelperDouble
                ->fromCamelCaseToSnakeCase($input),
            $expectedOutput
        );
    }

    public function testShouldConvertFromObjectToArray(): void
    {
        $object = new \stdClass();
        $object->id = 1;
        $object->name = 'test';
        $object->isActive = true;
        $this->assertEquals(
            $this
                ->converterHelperDouble
                ->fromObjectToArray($object),
            ['id' => 1, 'name' => 'test', 'is_active' => true]
        );
    }

    public function testShouldConvertFromObjectToArrayWithOnlyNotEmptyProps(): void
    {
        $object = new \stdClass();
        $object->id = 1;
        $object->name = '';
        $object->isActive = true;
        $this->assertEquals(
            $this
                ->converterHelperDouble
                ->fromObjectToArray($object, true),
            ['id' => 1, 'is_active' => true]
        );
    }

    public function testShouldConvertFromObjectToJson(): void
    {
        $object = new \stdClass();
        $object->id = 1;
        $object->name = 'test';
        $object->isActive = true;

        $this->assertEquals(
            '{"id":1,"name":"test","is_active":true}',
            $this
                ->converterHelperDouble
                ->fromObjectToJson($object)
        );
    }

    public function testShouldConvertFromObjectToJsonWithOnlyNotEmptyProps(): void
    {
        $object = new \stdClass();
        $object->id = '';
        $object->name = 'test';
        $object->isActive = true;

        $this->assertEquals(
            '{"name":"test","is_active":true}',
            $this
                ->converterHelperDouble
                ->fromObjectToJson($object, true)
        );
    }

    public function shouldConvertFromCamelCaseToSnakeCaseProvider(): array
    {
        return [
            ['camelCase', 'camel_case'],
            ['otherTestTest', 'other_test_test']
        ];
    }
}
