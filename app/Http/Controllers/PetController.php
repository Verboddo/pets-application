<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use Illuminate\Http\Request;
use App\Http\Requests\PetStoreRequest;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.pets.index', $this->getPets());
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
    public function store(PetStoreRequest $request)
    {
        $validated = $request->validated();

        $pet = Pets::create($validated);

        $pet->save();

        $returnHTML = view('tables.table-view')->with($this->getPets())->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pets $pets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pets $pets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pets $pets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pets $pets)
    {
        $pets->delete();

        $returnHTML = view('tables.table-view')->with($this->getPets())->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function getPets() {
        $pets = Pets::orderBy('name')->paginate(15);

        $petsTypeCount = Pets::orderBy('name')->get();

        $counted = $petsTypeCount->countBy(function ($type) {
            return $type->type;
        });

        $data = response()->json($pets->items());
        $counted = response()->json($counted->all());

        return ['data' => $data, 'counted' => $counted, 'pets' => $pets->withPath('/pets')];
    }

    public function getPetsPagination()
    {
        $returnHTML = view('tables.table-view')->with($this->getPets())->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
