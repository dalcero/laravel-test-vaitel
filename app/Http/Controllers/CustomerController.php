<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::getAll();

        return Inertia::render('Customer/Index',[
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = [
            'id'       => null,
            'name'     => null,
            'document' => null,
            'status'  => 'new',
            'numbers'  => [
                [
                    'number'      => null,
                    'status'      => 'active',
                    'preferences' => [
                        [
                            'name'  => 'auto_attendant',
                            'value' => '1',
                        ],
                        [
                            'name'  => 'voicemail_enabled',
                            'value' => '1',
                        ]
                    ]
                ]
            ]
        ];

        return Inertia::render('Customer/Register',[
            'customer' => $customer
        ]);
    }

    /**
     * Store a newly created/update resource in storage.
     *
     * @param  StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {

        try {
            DB::beginTransaction();

            $customer = Customer::updateOrCreate(
                [
                    "id"       => $request->id
                ],
                [
                    "name"     => $request->name,
                    "document" => $request->document,
                    "status"   => $request->status,
                    "user_id"  => auth()->id()
                ]
            );

            $customer->saveNumbers($request);

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer success register!');
        }catch (\Exception $e){
            DB::rollback();

            return redirect()->route('customers.index')->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $customer = [
            'id'       => $customer->id,
            'name'     => $customer->name,
            'document' => $customer->document,
            'status'   => $customer->status,
            'numbers'  => $customer->numbers->map(function ($number){
                return [
                    'id'          => $number->id,
                    'number'      => $number->number,
                    'status'      => $number->status,
                    'preferences' => $number->preferences->map(function ($preference){
                        return [
                            'id'    => $preference->id,
                            'name'  => $preference->name,
                            'value' => $preference->value,
                        ];
                    })
                ];
            })
        ];

        return Inertia::render('Customer/Register',[
            'customer' => $customer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer success delete!');
    }
}
