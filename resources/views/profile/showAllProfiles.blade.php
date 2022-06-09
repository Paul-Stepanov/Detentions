@extends('layouts.mainLayout')

@section('content')
   <div class="profiles__container">
      <h1 class="title">Список пользователей</h1>
      <ul class="profiles__list">
         <li class="profiles__list-item profiles__list-item--title">№</li>
         <li class="profiles__list-item profiles__list-item--title">ФИО</li>
         <li class="profiles__list-item profiles__list-item--title">Права доступа</li>
         <li class="profiles__list-item profiles__list-item--title">Подразделение</li>
         <li class="profiles__list-item profiles__list-item--title">Почта</li>
         <li class="profiles__list-item profiles__list-item--title">Телефон</li>
         <li class="profiles__list-item profiles__list-item--title">Дата регистрации</li>
         @foreach($users as $user)
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $serialNumber++ }}</a> </li>
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $user->name }}</a> </li>
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $user->role }}</a> </li>
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $user->division->title }}</a> </li>
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $user->email }}</a> </li>
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $user->phone }}</a> </li>
            <li class="profiles__list-item"><a class="profiles__list-item-link" href="{{ route('profile.edit', $user) }}">{{ $user->created_at->format('d.m.Y') }}</a> </li>
         @endforeach
      </ul>
      <button class="button button--mt">
         <a href="{{ route('register') }}"> Создать нового пользователя</a>
      </button>
      <button class="button button--mt">
         <a href="{{ url()->previous() }}"> Назад</a>
      </button>
   </div>

@endsection
