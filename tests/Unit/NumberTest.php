<?php

namespace Tests\Unit;

use App\Models\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_if_number_columns_is_correct()
    {
        $number = new Number;

        $expected = [
            'customer_id',
            'number',
            'status'
        ];

        $arrayCompared = array_diff($expected, $number->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
