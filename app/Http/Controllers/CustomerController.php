<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return CustomerResource::collection(Customer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  validation 
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:customers',
            'phone'     => 'required',
            'address'   => 'required',
            'type'      => ['required',Rule::in(['individual', 'corporate'])],
        ]);
        if ($validator->fails()) {
             
            return response(["Error" ,'errors' => $validator->errors() ,422]);
        }
        
        // create new customer
        $customer = auth()->user()->customers()->create([
            'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'address' => $request->address
        ]);
       
        return response(["Created" ,'customer' => $customer ,Response::HTTP_ACCEPTED]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
       
        return new CustomerResource($customer);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'address'   => 'required',
            'type'      => ['required',Rule::in(['individual', 'corporate'])],
        ]);
        if ($validator->fails()) {
             
            return response(["Error" ,'errors' => $validator->errors() ,422]);
        }
         $customer->update([
                'name' => $request->name,
                'user_id' => \Auth::id(),
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'address' => $request->address
            ]); 
         return response(["Updated" ,Response::HTTP_ACCEPTED]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
         
        $customer->delete();
        return response('Deleted',Response::HTTP_ACCEPTED);

    }
}
