@extends('layouts.mainLayout')

@section('title', 'Вид задержания')

@section('content')

   <div class="type">
      <h1 class="title">Виды задержаний:</h1>

      <div class="type__body">

         @foreach($types as $type)
            <div class="type__body-item">
               <span>{{ $serialNumber++ }}. </span>
               <p> {{ $type->title }}</p>
               <a class="button__edit-simple" href="{{ route('type.edit', $type) }}"> Редактировать </a>
            </div>


         @endforeach

      </div>

      <button class="type__button-create button">
         <a href="{{ route('type.create') }}">Создать новый вид задержания </a>
      </button>
{{--      раскоментировать при необходимости произвести импорт видов подразделений из Экселя--}}
{{--      <button class="division__button-create button">--}}
{{--         <a href="{{ route('type.import') }}">Импорт из Excel</a>--}}
{{--      </button>--}}
   </div>



@endsection
