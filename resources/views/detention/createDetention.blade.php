@extends('layouts.mainLayout')

@section('title', 'Создание записи задержания')

@section('content')

   <div class="detentions__create-page">

      <h1 class="title"> Внесение сведений о новом задержании</h1>

      <form class="form" action="{{ route('detention.store') }}" method="post">
         @csrf
         <div class="detentions__form-container">
            <label class="form__label" for="kusp"> КУСП №:
               <input class="form__input-text" type="number" name="kusp" id="kusp"
                      placeholder="Введите номер КУСП при его наличии" value="{{ old('kusp') }}">
               @error('kusp')
               <span class="error">*{{ $message }}</span>
               @enderror
            </label>
            <label class="form__label" for="date"> Дата:
               <input class="form__input-text" type="date" name="date" id="date" value="{{ old('date') }}">
               @error('date')
               <span class="error">*{{ $message }}</span>
               @enderror
            </label>
         </div>
         <div class="detentions__form-container">
            @if(auth()->user()->role == 'admin' or auth()->user()->role == 'moderator')
               <label class="form__label" for="division"> Подразделение:
                  <select class="form__select" name="division">
                     @if(old('division'))
                        <option value="{{ old('division') }}">{{ $division->find(old('division'))->title }}</option>
                     @else
                        <option class="form__option" value="title" disabled selected>Выберите подразделение</option>
                     @endif
                     @foreach( $division as $div)
                        <option value="{{ $div->id }}"> {{ $div->title }} </option>
                     @endforeach
                  </select>
                  @error('division')
                  <span class="error">*{{ $message }}</span>
                  @enderror
               </label>
            @else
               <input type="text" name="division" id="division" value="{{auth()->user()->division_id}}" hidden>
            @endif

            <label class="form__label" for="type"> Вид задержания:
               <select onchange="noteSelect(this)" class="form__select" name="type" id="typeSelect">
                  @if(old('type'))
                     <option value="{{ old('type') }}">{{ $type->find(old('type'))->title }}</option>
                  @else
                     <option class="form__option" value="title" disabled selected>Выберите вид задержания</option>
                  @endif
                  @foreach( $type as $t)
                     <option value="{{ $t->id }}"> {{ $t->title }} </option>
                  @endforeach
               </select>
               @error('type')
               <span class="error">*{{ $message }}</span>
               @enderror
            </label>
         </div>

         <label class="form__label" for="description"> Описание:
            <textarea class="form__textarea" name="description" id="description"
                      placeholder="Введите фабулу задержания">{{ old('description') }}</textarea>
            @error('description')
            <span class="error">*{{ $message }}</span>
            @enderror
         </label>

         <div class="detentions__form-container">
            <label class="form__label" for="explanation"> Примечание:
               <input class="form__input-text" type="text" name="explanation" id="explanation">
               @error('explanation')
               <span class="error">*{{ $message }}</span>
               @enderror
            </label>
            <label class="form__label detentions__note-select detentions__note-select--hide" for="note"
                   id="noteSelectLabel"> Основание снятия
               с рег. учета:
               <select class="form__select" name="note" id="note">
                  @if(old('note'))
                     <option value="{{ old('note') }}">{{ $note->find(old('note'))->title }}</option>
                  @else
                     <option class="form__option" value="title" disabled selected>Выберите основание прекращения
                        регистрации
                     </option>
                  @endif
                  @foreach( $note as $n)
                     <option value="{{ $n->id }}"> {{ $n->title }} </option>
                  @endforeach
               </select>
            </label>
         </div>

         <button class="form__btn-submit" type="submit">Сохранить</button>
      </form>

      <button class="detentions__form-button button">
         <a href="{{ route('detention.index') }}"> Назад</a>
      </button>

      <script onload="onLoadNoteSelect()" src="{{ asset('js/noteSelect.js') }}"></script>
   </div>

@endsection
