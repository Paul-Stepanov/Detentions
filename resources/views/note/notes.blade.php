@extends('layouts.mainLayout')

@section('title', 'Основания для прекращения регистрации')

@section('content')
   <div class="note">

      <h1 class="title">Основания для прекращения регистрации:</h1>

      <div class="note__body">

         @foreach($notes as $note)

            <div class="note__body-item">
               <span>{{ $serialNumber++ }}. </span>
               <p>  {{ $note->title }}</p>
               <a class="button__edit-simple" href="{{ route('note.edit', $note) }}"> Редактировать </a>
            </div>

         @endforeach
      </div>


      <button class="note__button-create button">
         <a href="{{ route('note.create') }}">Создать новое основание для прекращения регистрации </a>
      </button>
      {{--      раскоментировать при необходимости произвести импорт оснований прекращения регистрации из Экселя--}}
      {{--      <button class="division__button-create button">--}}
{{--         <a href="{{ route('note.import') }}">Импорт из Excel</a>--}}
{{--      </button>--}}
   </div>


@endsection
