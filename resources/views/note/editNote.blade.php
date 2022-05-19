@extends('layouts.mainLayout')

@section('title', 'Внесение нового основания прекращения регистрации')

@section('content')

   <div class="note__create-page">

      <h1>Основания для прекращения регистрации</h1>

      <form class="form" action="{{ route('note.update', $note) }}" method="post">
         @csrf
         @method('PATCH')
         <label class="form__label" for="title"> Основание прекращения регистрации:</label>
         <input class="form__input-text" type="text" name="title" id="title" value="{{ $note->title }}">
         <button class="form__btn-submit" type="submit">Сохранить</button>
      </form>

      <button class="note__button-back button">
         <a href="{{ route('note.index') }}">Назад</a>
      </button>


   </div>

@endsection
