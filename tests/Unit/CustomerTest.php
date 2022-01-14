<?php

namespace Tests\Unit;

use App\Models\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_check_if_customers_columns_is_correct()
    {
        $customer = new Customer;

        $expected = [
            'name',
            'user_id',
            'document',
            'status',
        ];

        $arrayCompared = array_diff($expected, $customer->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
