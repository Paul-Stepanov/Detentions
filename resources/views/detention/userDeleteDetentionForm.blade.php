@extends('layouts.mainLayout')

@section('title', 'Удаление записи задержания')

@section('content')
   <div class="detentions__create-page">
      <h1 class="title"> Удаление задержания</h1>

      <form class="form" @if($detention->detention_id)
      action="{{ route('editDetention.userDelete', ['detention'=>$detention->detention_id] )}}"
            @else
            action="{{ route('editDetention.userDelete', ['detention'=>$detention->id] )}}"
            @endif
            method="post">
         @csrf

         <div class="detentions__form">
            <label class="form__label" for="comment">
               Причина удаления записи:
               <textarea class="form__textarea" name="comment" id="comment"
                         placeholder="Введите причину удаления записи задержания"></textarea>
               @error('comment')
               <span class="error">*{{$message}}</span>
               @enderror
            </label>
            <button class="form__btn-submit button--wide"> Отправить</button>
         </div>
      </form>
      <button class="detentions__form-button button">
         <a href="{{ route('detention.index') }}"> Назад</a>
      </button>
   </div>

@endsection
