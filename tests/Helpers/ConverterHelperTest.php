<?php

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
        $this->converterHelperDouble = Mockery::mock(
            ConverterHelper::class
        )->makePartial();
    }

    /**
     * @param string $input
     * @param string $expectedOutput
     * @dataProvider fromCamelCaseToSnakeCaseProvider
     */
    public function testFromCamelCaseToSnakeCase($input, $expectedOutput)
    {
        $this->assertEquals(
            $this
                ->converterHelperDouble
                ->fromCamelCaseToSnakeCase($input),
            $expectedOutput
        );
    }

    public function testFromObjectToArray()
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

    public function fromCamelCaseToSnakeCaseProvider()
    {
        return [
            ['camelCase', 'camel_case'],
            ['otherTestTest', 'other_test_test']
        ];
    }
}
