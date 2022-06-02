@extends('layouts.mainLayout')

@section('title', 'Редактирование записи задержания')

@section('content')
   <div class="detentions__create-page">
      <h1 class="title"> Редактирование задержания</h1>
      <form class="form" action="
      @if($detention->detention_id)
      {{ route('editDetention.storingChanges', $detention->detention_id) }}
      @else
      {{ route('editDetention.storingChanges', $detention) }}
      @endif" method="post">
         @csrf
         <div class="detentions__form-container">
            <label class="form__label" for="kusp"> КУСП №:
               <input class="form__input-text" type="number" name="kusp" id="kusp"
                      placeholder="Введите номер КУСП при его наличии"
                      value="{{ old('kusp',$detention->kusp )  }}">
               @error('kusp')
               <sapn class="error">*{{ $message }}</sapn>
               @enderror
            </label>
            <label class="form__label" for="date"> Дата:
               <input class="form__input-text" type="date" name="date" id="date"
                      value="{{ old('date', $detention->date->format('Y-m-d'))  }}">
               @error('date')
               <sapn class="error">*{{ $message }}</sapn>
               @enderror
            </label>
         </div>

         <div class="detentions__form-container">

            <input type="text" name="division" id="division" value="{{ $detention->division_id }}"
                   hidden>

            <label class="form__label" for="type"> Вид задержания:
               <select onchange="noteSelect(this)" class="form__select" name="type" id="typeSelect">
                  <option value="title" disabled>Выберите вид задержания</option>
                  @if(old('type'))
                     <option value="{{ old('type') }}"
                             selected> {{ $type->find(old('type'))-> title }} </option>
                  @else
                     <option value="{{ $detention->type_id  }}"
                             selected> {{ $detention-> type-> title }} </option>
                  @endif
                  @foreach( $type as $t)
                     <option value="{{ $t->id }}"> {{ $t->title }} </option>
                  @endforeach
               </select>
            </label>
         </div>

         <label class="form__label" for="description"> Описание:
            <textarea class="form__textarea" name="description" id="description"
                      placeholder="Введите фабулу задержания"> {{ old('description', $detention-> description)  }}</textarea>
            @error('description')
            <sapn class="error">*{{ $message }}</sapn>
            @enderror
         </label>

         <div class="detentions__form-container">
            <label class="form__label" for="explanation"> Примечание:
               <input class="form__input-text" type="text" name="explanation" id="explanation"
                      value="{{ $detention-> explanation }}">
               @error('explanation')
               <sapn class="error">*{{ $message }}</sapn>
               @enderror
            </label>

            <label class="form__label detentions__note-select" for="note"
                   id="noteSelectLabel"> Основание снятия с рег. учета:
               <select class="form__select" name="note" id="selectValueNoteChange">
                  <option value="title" disabled>Выберите основание прекращения регистрации</option>
                  <option id="optionNoteSelected" value="{{ $detention-> note_id }}"
                          selected> @isset($detention->note->title) {{  $detention->note->title }} @endisset</option>
                  @foreach( $note as $n)
                     <option value="{{ $n->id }}"> {{ $n->title }} </option>
                  @endforeach
               </select>
               @error('note')
               <sapn class="error">*{{ $message }}</sapn>
               @enderror
            </label>
         </div>

         <button class="form__btn-submit" type="submit">Сохранить изменения</button>
      </form>

      <button class="detentions__form-button button">
         <a href="{{ route('detention.index') }}"> Назад</a>
      </button>

      <script onload="onLoadNoteSelect()" src="{{ asset('js/noteSelect.js') }}"></script>
   </div>
@endsection
