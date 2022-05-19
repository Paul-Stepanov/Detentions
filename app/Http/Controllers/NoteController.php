<?php

namespace App\Http\Controllers;

use App\Imports\NotesImport;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class NoteController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      $notes = Note::all();
      return view('note.notes', compact('notes'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create() {
      return view('note.createNote');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request) {
      Note::query()->create([
         'title' => $request->input('title'),
      ]);
      return redirect()->route('note.index');
   }

   /**
    * Display the specified resource.
    *
    * @param \App\Models\Note $note
    * @return \Illuminate\Http\Response
    */
   public function show(Note $note) {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Models\Note $note
    * @return \Illuminate\Http\Response
    */
   public function edit(Note $note) {
      return view('note.editNote', compact('note'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\Note $note
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Note $note) {
      $note->update($request->all());
      return redirect()->route('note.index');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param \App\Models\Note $note
    * @return \Illuminate\Http\Response
    */
   public function destroy(Note $note) {
//
   }

   public function import() {
      Excel::import(new NotesImport(), 'notesImport.xlsx');
      return redirect()->route('note.index');
   }
}
