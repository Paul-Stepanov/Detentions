<?php

namespace App\Http\Controllers;

use App\Exports\DetentionsExport;
use App\Imports\DetentionsImport;
use App\Models\Detention;
use App\Models\Note;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DetentionController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function index() {
      if (auth()->user()->role == 'admin' or auth()->user()->role == 'moderator') {
         $detention = Detention::query()->orderByDesc('date')->paginate(10);
      } else {
         $detention = Detention::query()->where('division_id', auth()->user()->division_id)->orderByDesc('date')->paginate(10);
      }
      return view('detention.detentions', compact('detention'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create() {
      $type = Type::all();
      $note = Note::all();
      return view('detention.createDetention', compact('type', 'note'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param Request $request
    * @return Response
    */
   public function store(Request $request) {
      $validationRules = [
         'kusp' => 'nullable|numeric',
         'date' => 'required',
         'division' => 'required',
         'type' => 'required',
         'description' => 'required',
         'explanation' => 'max:50',
      ];

      $errorMessage = [
         'max' => 'Введите не более :max символов',
         'required' => 'Поле обязательно для заполнения',
         'numeric' => 'Доступен ввод только цифр',
      ];

      $request->validate($validationRules, $errorMessage);

      Auth::user()->detentions()->create([
         'kusp' => $request->input('kusp'),
         'date' => $request->input('date'),
         'division_id' => $request->input('division'),
         'type_id' => $request->input('type'),
         'description' => $request->input('description'),
         'explanation' => $request->input('explanation'),
         'note_id' => $request->input('note'),
      ]);

      return redirect()->route('detention.index');
   }

   /**
    * Display the specified resource.
    *
    * @param Detention $detention
    * @return Response
    */
   public function show(Detention $detention) {
      $userUpdate = User::query()->find($detention->user_update);
      return view('detention.showDetention', compact('detention', 'userUpdate'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param Detention $detention
    * @return Response
    */
   public function edit(Detention $detention) {
      $type = Type::all();
      $note = Note::all();
      return view('detention.editDetention', compact('detention', 'type', 'note'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param Request $request
    * @param Detention $detention
    * @return Response
    */
   public function update(Request $request, Detention $detention) {

      $validationRules = [
         'kusp' => 'sometimes|nullable|numeric',
         'date' => 'required',
         'division' => 'required',
         'type' => 'required',
         'description' => 'required',
         'explanation' => 'max:50',
      ];

      $errorMessage = [
         'max' => 'Введите не более :max символов',
         'required' => 'Поле обязательно для заполнения',
         'numeric' => 'Доступен ввод только цифр',
      ];
      $request->validate($validationRules, $errorMessage);

      $detention->update([
         'kusp' => $request->input('kusp'),
         'date' => $request->input('date'),
         'division_id' => $request->input('division'),
         'type_id' => $request->input('type'),
         'description' => $request->input('description'),
         'explanation' => $request->input('explanation'),
         'note_id' => $request->input('note'),
         'user_update' => auth()->user()->id,
      ]);

      return redirect()->route('detention.index');

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param Detention $detention
    * @return Response
    */
   public function destroy(Detention $detention) {
      $detention->delete();
      return redirect()->route('detention.index');
   }

   public function export() {
      return Excel::download(new DetentionsExport, 'detention.xlsx');
   }

   public function import() {
      Excel::import(new DetentionsImport(), 'detentionsImport.xlsx');
      return redirect()->route('detention.index');
   }


}
