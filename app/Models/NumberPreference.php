<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberPreference extends Model
{
    use SoftDeletes;

    protected $table = 'number_preferences';

    protected $fillable = [
        'number_id',
        'name',
        'value',
    ];

    /**
     * Get the number.
     */
    public function number()
    {
        return $this->hasOne(Number::class);
    }
}
