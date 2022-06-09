@extends('layouts.mainLayout')

@section('title', 'Задержание')

@section('content')
   <div class="detentions__show-card-wrapper">
      <h1 class="title">Задержание</h1>
      <div class="detentions__show-card-body">
         @if($detention->kusp)
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">КУСП:</p>
               <p class="detentions__show-card-body-item">{{ $detention->kusp }}</p>
            </div>
         @endif
         <div class="detentions__show-card-body-block">
            <p class="detentions__show-card-body-title">Дата задержания:</p>
            <p class="detentions__show-card-body-item">{{ $detention->date->format('d.m.Y') }}</p>
         </div>
         <div class="detentions__show-card-body-block">
            <p class="detentions__show-card-body-title">Подразделение:</p>
            <p class="detentions__show-card-body-item">{{ $detention->division->title }}</p>
         </div>
         <div class="detentions__show-card-body-block">
            <p class="detentions__show-card-body-title">Вид задержания:</p>
            <p class="detentions__show-card-body-item">{{ $detention->type->title }}</p>
         </div>
         <div class="detentions__show-card-body-block">
            <p class="detentions__show-card-body-title">Фабула:</p>
            <p class="detentions__show-card-body-item">{{ $detention->description }}</p>
         </div>
         @if($detention->note)
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">Основания прекращения регистрации:</p>
               <p class="detentions__show-card-body-item">{{ $detention->note->title }}</p>
            </div>
         @endif
         @if($detention->explanation)
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">Примечание:</p>
               <p class="detentions__show-card-body-item">{{ $detention->explanation }}</p>
            </div>
         @endif
         <div class="detentions__show-card-body-block">
            <p class="detentions__show-card-body-title">Дата создания записи:</p>
            <p class="detentions__show-card-body-item">{{ $detention->created_at->format('d.m.Y H:i:s') }}</p>
         </div>
         @if($detention->user)
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">Пользователь создавший запись:</p>
               <p class="detentions__show-card-body-item">{{ $detention->user->name }}
                  (СЭП: {{ $detention->user->email }})</p>
            </div>
         @else
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">Пользователь создавший запись:</p>
               <p class="detentions__show-card-body-item">Автозаполнение</p>
            </div>
         @endif
         <div class="detentions__show-card-body-block">
            <p class="detentions__show-card-body-title">Дата обновления записи:</p>
            <p class="detentions__show-card-body-item">{{ $detention->updated_at->format('d.m.Y H:i:s') }}</p>
         </div>
         @if($userUpdate)
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">Пользователь обновивший запись:</p>
               <p class="detentions__show-card-body-item">{{ $userUpdate->name }},
                  СЭП: {{ $userUpdate->email }}@isset($userUpdate->phone), тел.:{{ $userUpdate->phone }})
                  @endisset

               </p>
            </div>
         @else
            <div class="detentions__show-card-body-block">
               <p class="detentions__show-card-body-title">Пользователь обновивший запись:</p>
               <p class="detentions__show-card-body-item">Запись не редактировалась</p>
            </div>
         @endif
      </div>
      <button class="detentions__form-button button">
         <a href="{{url()->previous() }}"> Назад</a>
      </button>
   </div>
@endsection
