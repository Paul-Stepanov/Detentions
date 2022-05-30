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
         'edit_kusp' => $request->input('kusp'),
         'edit_date' => $request->input('date'),
         'edit_division_id' => $request->input('division'),
         'edit_type_id' => $request->input('type'),
         'edit_description' => $request->input('description'),
         'edit_explanation' => $request->input('explanation'),
         'edit_note_id' => $request->input('note'),
         'detention_id' => $detention->id,
      ]);

      if (!$detention->editing) {
         $detention->editing = 1;
         $detention->save();
      }
      return redirect()->route('detention.index');
   }

   public function showChangedDetention() {

      $detentions = Detention::query()->where('editing', 1)->get();

      return view('detention.showChangedDetention', compact('detentions'));
   }

   public function confirmChanges(Request $request, EditDetention $editDetention) {

      $editDetention->detention()->update($request->except('_token'));
      $detention = $editDetention->detention;
      $editDetention->delete();
      if ($detention->edit_detentions->count() == 0) {
         $detention->update([
            'editing' => 0
         ]);
      }
      return redirect()->back();
   }
}
