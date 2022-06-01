<?php

namespace App\Http\Controllers;

use App\Models\Detention;
use App\Models\EditDetention;
use App\Models\Note;
use App\Models\Type;
use Illuminate\Http\Request;

class EditDetentionController extends Controller
{
   public function userEditDetention(Detention $detention) {

      if ($detention->edit_detentions->count() > 0) {
         $detention = $detention->edit_detentions->last();
      }

      $type = Type::all();
      $note = Note::all();
      return view('detention.userEditDetention', compact('detention', 'type', 'note'));
   }

   public function storingChanges(Request $request, Detention $detention) {

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

      EditDetention::query()->create([
         'kusp' => $request->input('kusp'),
         'date' => $request->input('date'),
         'division_id' => $request->input('division'),
         'type_id' => $request->input('type'),
         'description' => $request->input('description'),
         'explanation' => $request->input('explanation'),
         'note_id' => $request->input('note'),
         'detention_id' => $detention->id,
      ]);

      if (!$detention->editing) {
         $detention->editing = 1;
         $detention->save();
      }
      return redirect()->route('detention.index');
   }

   public function showChangedDetention() {

      $detentions = Detention::query()->where('editing', 1)->orWhere('deleting', 1)->get();

      return view('detention.showChangedDetention', compact('detentions'));
   }

   public function confirmChanges(Request $request, EditDetention $editDetention) {

      $detention = $editDetention->detention;

      if ($request->submit != 'reject') {
         $editDetention->detention()->update($request->except('_token'));
      }
      $editDetention->delete();
      if ($detention->edit_detentions->count() == 0) {
         $detention->update([
            'editing' => 0
         ]);
      }
      return redirect()->back();
   }

   public function userDeleteDetention(Request $request, Detention $detention) {

      if ($request->submit == 'reject') {
         $detention->deleting = 0;
         $detention->comment_to_deleting = '';
      } else {
         $validationRules = [
            'comment' => 'required',
         ];

         $errorMessage = [
            'required' => 'Поле обязательно для заполнения',
         ];

         $request->validate($validationRules, $errorMessage);

         $detention->comment_to_deleting = $request->input('comment');
         $detention->deleting = 1;
      }
      $detention->save();

      return redirect()->back();
   }

   public function userDeleteDetentionForm(Detention $detention) {
      return view('detention.userDeleteDetentionForm', compact('detention'));
   }
}
