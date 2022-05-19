<?php

namespace App\Http\Controllers;

use App\Imports\TypesImport;
use App\Models\Type;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      $types = Type::all();
      return view('type.types', compact('types'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create() {
      return view('type.createType');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request) {
      Type::query()->create([
         'title' => $request->input('title'),
      ]);
      return redirect()->route('type.index');
   }

   /**
    * Display the specified resource.
    *
    * @param \App\Models\Type $type
    * @return \Illuminate\Http\Response
    */
   public function show(Type $type) {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Models\Type $type
    * @return \Illuminate\Http\Response
    */
   public function edit(Type $type) {
      return view('type.editType', compact('type'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\Type $type
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Type $type) {
      $type->update($request->all());
      return redirect()->route('type.index');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param \App\Models\Type $type
    * @return \Illuminate\Http\Response
    */
   public function destroy(Type $type) {
      //
   }

   public function import() {
      Excel::import(new TypesImport(), 'typesImport.xlsx');
      return redirect()->route('type.index');
   }
}
