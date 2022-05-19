@extends('layouts.mainLayout')

@section('title', 'Внесение нового вида задержания')

@section('content')

   <div class="type__create-page">

      <h1 class="title">Внесение сведений о виде задержания</h1>

      <form class="form" action="{{ route('type.store') }}" method="post">
         @csrf
         <label class="form__label" for="title"> Введите новый вид задержания:</label>
         <input class="form__input-text" type="text" name="title" id="title">

         <button class="form__btn-submit" type="submit">Сохранить</button>
      </form>

      <button class="type__button-back button">
         <a href="{{ route('type.index') }}">Назад</a>
      </button>

   </div>

@endsection
