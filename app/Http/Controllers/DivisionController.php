<?php

namespace App\Http\Controllers;

use App\Imports\DivisionsImport;
use App\Models\Division;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DivisionController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      $divisions = Division::all();
      return view('division.divisions', compact('divisions'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create() {
      return view('division.createDivision');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request) {
      Division::query()->create([
         'title' => $request->input('title'),
      ]);
      return redirect()->route('division.index');
   }

   /**
    * Display the specified resource.
    *
    * @param \App\Models\Division $division
    * @return \Illuminate\Http\Response
    */
   public function show(Division $division) {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Models\Division $division
    * @return \Illuminate\Http\Response
    */
   public function edit(Division $division) {
      return view('division.editDivision', compact('division'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\Division $division
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Division $division) {
      $division->update($request->all());
      return redirect()->route('division.index');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param \App\Models\Division $division
    * @return \Illuminate\Http\Response
    */
   public function destroy(Division $division) {
      //
   }

   public function import() {
      Excel::import(new DivisionsImport(), 'divisionsImport.xlsx');
      return redirect()->route('division.index');
   }
}
