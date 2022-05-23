@extends('layouts.mainLayout')

@section('title', 'Поиск')

@section('search')
   <div id="searchWindow" class="search-window">

      <div class="search-window__inner">
         <div class="search-window__close">
            <h1 class="title title--search">Поиск:</h1>

            <div class="search-window__close-container">
               <a href="{{ route('detention.index') }}">
                  <img src="{{ asset('img/icons/search-close.png')  }}" alt="close"
                       class="search-window__close-img">
               </a>
            </div>
         </div>

         <form action=" {{ route('search.createSearchResults') }}" method="post" class="form">
            @csrf
            <label class="form__label" for="kusp"> КУСП №:
               <input class="form__input-text" type="number" name="kusp" id="kusp"
                      placeholder="Введите номер КУСП">
            </label>

            <div class="search-window__form-container">
               <label class="form__label" for="dateStart"> Дата с:
                  <input class="form__input-text" type="date" name="dateStart" id="dateStart">
               </label>
               <label class="form__label" for="dateEnd"> Дата по:
                  <input class="form__input-text" type="date" name="dateEnd" id="dateEnd">
               </label>
            </div>

            <div class="search-window__form-container">
               @if(auth()->user()->role == 'admin' or auth()->user()->role =='moderator')
                  <label class="form__label" for="division"> Подразделение:
                     <select class="form__select" name="division">
                        <option class="form__option" value="title" disabled selected>Выберите подразделение</option>
                        @foreach( $division as $div)
                           <option value="{{ $div->id }}"> {{ $div->title }} </option>
                        @endforeach
                     </select>
                  </label>
               @else
                  <input type="text" name="division" id="division"
                         value="{{ auth()->user()->division_id}}" hidden>
               @endif
               <label class="form__label" for="type"> Вид задержания:
                  <select onchange="noteSelect(this)" class="form__select" name="type" id="typeSelect">
                     <option value="title" disabled selected>Выберите вид задержания</option>
                     @foreach( $type as $t)
                        <option value="{{ $t->id }}"> {{ $t->title }} </option>
                     @endforeach
                  </select>
               </label>
            </div>

            <div class="search-window__form-container">
               <label class="form__label" for="explanation"> Примечание:
                  <input class="form__input-text" type="text" name="explanation" id="explanation">
               </label>
               <label class="form__label detentions__note-select" for="note" id="noteSelectLabel"> Основание снятия
                  с рег. учета:
                  <select class="form__select" name="note" id="note">
                     <option value="title" disabled selected>Выберите основание прекращения регистрации</option>
                     @foreach( $note as $n)
                        <option value="{{ $n->id }}"> {{ $n->title }} </option>
                     @endforeach
                  </select>
               </label>
            </div>

            <label class="form__label" for="description"> Описание:
               <textarea class="form__textarea" name="description" id="description"
                         placeholder="Введите текст содержащийся в фабуле"></textarea>
            </label>

            <button class="form__btn-submit" type="submit">Поиск</button>
         </form>

      </div>
   </div>
@endsection
