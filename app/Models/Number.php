<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Number extends Model
{
    use SoftDeletes;

    protected $table = 'numbers';

    protected $fillable = [
        'customer_id',
        'number',
        'status', // active, inactive, cancelled
    ];

    /**
     * Get the customer.
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Get the preferences in number
     */
    public function preferences()
    {
        return $this->hasMany(NumberPreference::class);
    }
}
