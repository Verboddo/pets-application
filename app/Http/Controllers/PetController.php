<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'address' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'type' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
        ]);

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
        // return response()->json(['success'=>'Pet succesvol verwijderd!']);
    }

    public function getPets() {
        $pets = Pets::orderBy('name')->get();

        $counted = $pets->countBy(function ($type) {
            return $type->type;
        });

        $data = response()->json($pets);
        $counted = response()->json($counted->all());

        return ['data' => $data, 'counted' => $counted];
    }
}
