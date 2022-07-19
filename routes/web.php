<?php

use App\Http\Controllers\DetentionController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EditDetentionController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SortController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/* -----------------------------------------------------------------------------
   Роуты авторизации и регистрации ↓
--------------------------------------------------------------------------------*/
Auth::routes();

/* ------------------------------------------------------------------------------
   Главная страница ↓
---------------------------------------------------------------------------------*/
Route::get('/', [DetentionController::class, 'index'])->middleware('auth');

/* -------------------------------------------------------------------------------
   Основные роуты по работе с задержаниями, в том числе экспорт и импорт в эксель,
   а также подтверждением корректировки и удаления записей пользователями ↓
---------------------------------------------------------------------------------*/
Route::prefix('app')->middleware('auth')->group(function () {
   Route::resource('detention', DetentionController::class);
   Route::resource('division', DivisionController::class);
   Route::resource('type', TypeController::class);
   Route::resource('note', NoteController::class);
   Route::get('detentions/export/', [DetentionController::class, 'export'])->name('detention.export');
   Route::get('detentions/import/', [DetentionController::class, 'import'])->name('detention.import');
   Route::get('divisions/import/', [DivisionController::class, 'import'])->name('division.import');
   Route::get('types/import/', [TypeController::class, 'import'])->name('type.import');
   Route::get('notes/import/', [NoteController::class, 'import'])->name('note.import');
   Route::post('detentions/storingChanges/{detention}', [EditDetentionController::class, 'storingChanges'])->name('editDetention.storingChanges');
   Route::get('detentions/{detention}/userEdit', [EditDetentionController::class, 'userEditDetention'])->name('editDetention.userEdit');
   Route::post('detentions/userDelete/{detention}', [EditDetentionController::class, 'userDeleteDetention'])->name('editDetention.userDelete');
   Route::get('detentions/userDelete/{detention}', [EditDetentionController::class, 'userDeleteDetentionForm'])->name('editDetention.userDeleteForm');
   Route::get('detentions/showChanged', [EditDetentionController::class, 'showChangedDetention'])->name('editDetention.showChangedDetention');
   Route::post('detentions/confirm/{editDetention}', [EditDetentionController::class, 'confirmChanges'])->name('editDetention.confirmChanges');
});

/* -----------------------------------------------------------------------------
   Роуты поиска задержаний по различным критериям ↓
----------------------------------------------------------------------------- */
Route::prefix('search')->middleware('auth')->group(function () {
   Route::get('show_form', [SearchController::class, 'showForm'])->name('search.showForm');
   Route::post('create_results', [SearchController::class, 'createSearchResults'])->name('search.createSearchResults');
   Route::get('show_results', [SearchController::class, 'showSearchResults'])->name('search.showSearchResults');
   Route::get('detentions/export', [SearchController::class, 'export'])->name('search.export');
});

/*-----------------------------------------------------------------------------
   Роут сортировки задержаний на главной странице ↓
 -----------------------------------------------------------------------------*/
Route::prefix('sort')->group(function () {
   Route::get('column/{column}/sorted/{sorted}', [SortController::class, 'sortColumn'])->name('sort.sortColumn');
});

/*-----------------------------------------------------------------------------
   Роуты формирования отчетов ↓
-----------------------------------------------------------------------------*/
Route::prefix('report')->middleware('auth')->group(function () {
   Route::get('type', [ReportController::class, 'showTypeReport'])->name('report.showTypeReport');
   Route::post('type', [ReportController::class, 'createTypeReport'])->name('report.createTypeReport');
   Route::get('type/export', [ReportController::class, 'exportTypeReport'])->name('report.typeExport');
   Route::get('division', [ReportController::class, 'showDivisionReport'])->name('report.showDivisionReport');
   Route::post('division', [ReportController::class, 'createDivisionReport'])->name('report.createDivisionReport');
   Route::get('division/export', [ReportController::class, 'exportDivisionReport'])->name('report.divisionExport');
   Route::get('advanced/show', [ReportController::class, 'showAdvancedReport'])->name('report.showAdvancedReport');
   Route::post('advanced/create', [ReportController::class, 'createAdvancedReport'])->name('report.createAdvancedReport');
   Route::get('advanced/show_form', [ReportController::class, 'showFormAdvancedReport'])->name('report.showFormAdvancedReport');
   Route::get('advanced/export', [ReportController::class, 'exportAdvancedReport'])->name('report.advancedExport');
});

/*-----------------------------------------------------------------------------
   Роуты просмотра и редактирования профиля пользователя ↓
----------------------------------------------------------------------------- */
Route::prefix('profile')->middleware('auth')->group(function () {
   Route::get('/', [UserController::class, 'index'])->name('profile.index')->middleware('can:viewAny, App\Models\User');
   Route::get('{user}/edit', [UserController::class, 'edit'])->name('profile.edit')->middleware('can:view,user');
   Route::patch('{user}', [UserController::class, 'update'])->name('profile.update')->middleware('can:update,user');
   Route::delete('{user}', [UserController::class, 'destroy'])->name('profile.destroy')->middleware('can:delete,user');
});



