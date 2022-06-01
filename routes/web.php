<?php

use App\Http\Controllers\DetentionController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EditDetentionController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SortController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [DetentionController::class, 'index'])->middleware('auth');

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

Route::prefix('search')->middleware('auth')->group(function () {
   Route::get('show_form', [SearchController::class, 'showForm'])->name('search.showForm');
   Route::post('create_results', [SearchController::class, 'createSearchResults'])->name('search.createSearchResults');
   Route::get('show_results', [SearchController::class, 'showSearchResults'])->name('search.showSearchResults');
   Route::get('detentions/export', [SearchController::class, 'export'])->name('search.export');
});

Route::prefix('sort')->group(function () {
   Route::get('column/{column}/sorted/{sorted}', [SortController::class, 'sortColumn'])->name('sort.sortColumn');
});

Route::prefix('report')->middleware('auth')->group(function () {
   Route::get('type', [ReportController::class, 'showTypeReport'])->name('report.showTypeReport');
   Route::post('type', [ReportController::class, 'createTypeReport'])->name('report.createTypeReport');
   Route::get('type/export', [ReportController::class, 'exportTypeReport'])->name('report.typeExport');
   Route::get('division', [ReportController::class, 'showDivisionReport'])->name('report.showDivisionReport');
   Route::post('division', [ReportController::class, 'createDivisionReport'])->name('report.createDivisionReport');
   Route::get('division/export', [ReportController::class, 'exportDivisionReport'])->name('report.divisionExport');
});



