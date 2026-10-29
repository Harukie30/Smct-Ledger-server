<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
        $page = $request->input("per_page");
        $location = Location::select(['id', 'location_name'])
                        ->when($search, fn($q) => $q->whereLike('location_name', "%{$search}%"))
                        ->paginate($page);

        return response()->json(
            [
                'locations'     =>  $location
            ]
            ,200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'location_name'     =>  ['required', 'string']
            ]
        );

        Location::create(
            [
                'location_name'     =>  $validate['location_name']
            ]
        );

        return response()->json(
            [
                'message'   =>  "Location Successfully Added"
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return response()->json(
            [
                'message'   =>   $location->load(
                                            [
                                                'installments'  =>  fn($q)  =>  $q->select(['id','location_id','internal_id', 'customer_name', 'so_number', 'purchase_date'])
                                            ]
                                        )
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validate = $request->validate(
            [
                'location_name'     =>  ['required', 'string']
            ]
        );

        $location->update(
            [
                'location_name'     =>  $validate['location_name']
            ]
        );

        return response()->json(
            [
                'message'   =>  "Location Successfully Updated"
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(
            [
                'message'   =>  "Location Successfully Deleted"
            ]
            ,200
        );
    }
}
