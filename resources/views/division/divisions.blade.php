@extends('layouts.mainLayout')

@section('title', ' Подразделения ГИБДД')

@section('content')



   <div class="division">

      <h1 class="title">Подразделения:</h1>

      <div class="division__body">

         @foreach($divisions as $division)

            <div class="division__body-item">
               <span>{{ $serialNumber++ }}. </span>
               <p> {{ $division->title }} </p>
               <a class="button__edit-simple" href="{{ route('division.edit', $division) }}"> Редактировать </a>
            </div>


         @endforeach

      </div>
      <button class="division__button-create button">
         <a href="{{ route('division.create') }}">Внести новое подразделение</a>
      </button>
      {{--      раскоментировать при необходимости произвести импорт подразделений из Экселя--}}
      {{--      <button class="division__button-create button">--}}
{{--         <a href="{{ route('division.import') }}">Импорт из Excel</a>--}}
{{--      </button>--}}
   </div>

@endsection
