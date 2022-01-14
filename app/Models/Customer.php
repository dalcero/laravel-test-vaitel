<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'user_id',
        'document',
        'status', // new, active, suspended, cancelled
    ];

    /**
     * Get the numbers.
     */
    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    /**
     * Save numbers.
     */
    public function saveNumbers($request)
    {
        $this->numbers()->delete();

        foreach ($request->numbers as $data){
            $number = $this->numbers()->create([
                "number" => $data['number'],
                "status" => $data['status']
            ]);

            foreach ($data['preferences'] as $preference){
                $number->preferences()->create([
                    "name"  => $preference['name'],
                    "value" => $preference['value']
                ]);
            }
        }
    }

    /**
     * Get customers with filter Role.
     */
    public static function getAll()
    {
        $customers = Customer::query();

        if(auth()->user()->hasRole('admin'))
            $customers->where('user_id', auth()->id());

        return $customers->get()->map(function ($customer) {
            return [
                'id'       => $customer->id,
                'name'     => $customer->name,
                'document' => $customer->document,
                'status'   => $customer->status,
                'numbers'  => $customer->numbers->count()
            ];
        });
    }
}
