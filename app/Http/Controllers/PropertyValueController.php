<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyValueRequest;
use App\Http\Requests\UpdatePropertyValueRequest;
use App\Models\PropertyValue;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePropertyValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyValueRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyValue  $propertyValue
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyValue $propertyValue)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyValue  $propertyValue
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyValue $propertyValue)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertyValueRequest  $request
     * @param  \App\Models\PropertyValue  $propertyValue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyValueRequest $request, PropertyValue $propertyValue)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyValue  $propertyValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyValue $propertyValue)
    {
    }
}
