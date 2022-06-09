@extends('layouts.mainLayout')

@section('content')
   <div class="form__container form__container--auth">
      <div class="title">{{ __('Профиль') }}</div>

      <form class="form" method="POST" action="{{ route('profile.update', $user) }}">
         @csrf
         @method('PATCH')
         <label for="name" class="form__label">{{ __('ФИО') }}
            <input id="name" type="text" class="form__input-text" name="name"
                   value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>
         @if(auth()->user()->role == 'admin')
            <label for="role" class="form__label">{{ __('Права доступа') }}
               <select class="form__select" name="role" id="role">
                  <option value="{{ $user->role }}">{{ $user->role }}</option>
                  <option value="admin">admin</option>
                  <option value="moderator">moderator</option>
                  <option value="user">user</option>
               </select>
               @error('role')
               <span class="error" role="alert">*{{ $message }}</span>
               @enderror
            </label>

            <label for="division" class="form__label">{{ __('Подразделение') }}
               <select class="form__select" name="division" id="division">
                  <option value="{{ $user->division->title }}">{{ $user->division->title }}</option>
                  @foreach($division as $div)
                     <option value="{{ $div->title }}">{{$div->title}}</option>
                  @endforeach
               </select>
               @error('division')
               <span class="error" role="alert">*{{ $message }}</span>
               @enderror
            </label>
         @endif

         <label for="email" class="form__label">{{ __('Почта') }}
            <input id="email" type="text" class="form__input-text" name="email"
                   value="{{ old('email', $user->email) }}" required autofocus>
            @error('email')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>

         <label for="phone" class="form__label">{{ __('Номер мобильного телефона') }}
            <input id="phone" type="tel" class="form__input-text"
                   name="phone" value="{{ old('phone', $user->phone) }}"
                   placeholder="Введите номер в формате 89998887766">
            @error('phone')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>
         <button type="submit" class="form__btn-submit">
            {{ __('Сохранить изменения') }}
         </button>
         <br>
         @if(auth()->user()->role == 'admin')
            <form action="{{route('profile.destroy', $user)}}">
               @csrf
               @method('DELETE')
               <button class="button button__delete-simple" type="submit">Удалить пользователя</button>
            </form>
         @endif
      </form>
      <button class="button button--mt">
         <a href="{{ url()->previous() }}"> Назад</a>
      </button>
   </div>
@endsection
