@extends('layouts.mainLayout')

@section('title', ' Подразделения ГИБДД')

@section('content')

   <div class="division__create-page">

      <h1 class="title">Внесение сведений о новом подразделении</h1>


      <form class="form" action="{{ route('division.update', $division) }}" method="post">
         @csrf
         @method('PATCH')
         <label class="form__label" for="title"> Введите наименование подразделения:</label>
         <input class="form__input-text" type="text" name="title" id="title" value="{{ $division->title }}">
         <button class="form__btn-submit" type="submit">Сохранить</button>
      </form>
      <button class="division__button-back button">
         <a href="{{ route('division.index') }}">Назад</a>
      </button>

   </div>


@endsection
