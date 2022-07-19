<?php

namespace App\Http\Controllers;

use App\Exports\DetentionsExport;
use App\Imports\DetentionsImport;
use App\Models\Detention;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DetentionController extends Controller
{

   public function index() {//отображение всех задержаний на главной странице в зависимости от роли пользователя
      if (auth()->user()->role == 'admin' or auth()->user()->role == 'moderator') {
         $detention = Detention::query()->orderByDesc('date')->paginate(10);
      } else {
         $detention = Detention::query()->where('division_id', auth()->user()->division_id)->orderByDesc('date')->paginate(10);
      }

      return view('detention.detentions', compact('detention'));
   }

   public function create() {//отображение страницы создания задержания

      return view('detention.createDetention');
   }


   public function store(Request $request): RedirectResponse {//сохранение записи задержания в базе данных

      $validationRules = [//правила валидации данных
         'kusp' => 'nullable|numeric',
         'date' => 'required',
         'division' => 'required',
         'type' => 'required',
         'description' => 'required',
         'explanation' => 'max:50',
      ];

      $errorMessage = [//сообщения об ошибках при неудачной валидации введенных в форму данных
         'max' => 'Введите не более :max символов',
         'required' => 'Поле обязательно для заполнения',
         'numeric' => 'Доступен ввод только цифр',
      ];

      $request->validate($validationRules, $errorMessage);//валидация введенных в форму данных

      Auth::user()->detentions()->create([//массовое присвоение данных в базу, от имени авторизованного пользователя
         'kusp' => $request->input('kusp'),
         'date' => $request->input('date'),
         'division_id' => $request->input('division'),
         'type_id' => $request->input('type'),
         'description' => $request->input('description'),
         'explanation' => $request->input('explanation'),
         'note_id' => $request->input('note'),
      ]);

      return redirect()->route('detention.index');// перенаправление на главную страницу
   }

   public function show(Detention $detention) {//отображение карточки задержания
      $userUpdate = User::query()->find($detention->user_update);// поиск пользователя обновившего запись, для последующей передачи его во view
      return view('detention.showDetention', compact('detention', 'userUpdate'));
   }

   public function edit(Detention $detention) {//отображение карточки редактирования записи задержания

      return view('detention.editDetention', compact('detention'));
   }

   public function update(Request $request, Detention $detention): RedirectResponse {//обновление записи задержания

      $validationRules = [//правила валидации
         'kusp' => 'sometimes|nullable|numeric',
         'date' => 'required',
         'division' => 'required',
         'type' => 'required',
         'description' => 'required',
         'explanation' => 'max:50',
      ];

      $errorMessage = [//сообщения об ошибках валидации
         'max' => 'Введите не более :max символов',
         'required' => 'Поле обязательно для заполнения',
         'numeric' => 'Доступен ввод только цифр',
      ];

      $request->validate($validationRules, $errorMessage);//валидация данных введенных в форму

      $detention->update([//массовое обновление данных в базе
         'kusp' => $request->input('kusp'),
         'date' => $request->input('date'),
         'division_id' => $request->input('division'),
         'type_id' => $request->input('type'),
         'description' => $request->input('description'),
         'explanation' => $request->input('explanation'),
         'note_id' => $request->input('note'),
         'user_update' => auth()->user()->id,
      ]);

      return redirect()->route('detention.index');//перенаправление на главную страницу
   }

   public function destroy(Detention $detention): RedirectResponse {//удаление задержания из базы данных
      $detention->delete();
      return redirect()->route('detention.index');//перенаправление на главную страницу
   }

   public function export(): BinaryFileResponse {//експорт всех задержаний в эксель
      return Excel::download(new DetentionsExport, 'detention.xlsx');
   }

   public function import(): RedirectResponse {//импорт задержаний из экселя, из файла detentionsImport.xlsx содержащегося в папке storage/app
      Excel::import(new DetentionsImport(), 'detentionsImport.xlsx');
      return redirect()->route('detention.index');//перенаправление на главную страницу
   }
}
