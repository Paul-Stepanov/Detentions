@extends('layouts.mainLayout')

@section('content')
   <div class="form__container form__container--auth">
      <div class="title">{{ __('Регистрация') }}</div>

      <form class="form" method="POST" action="{{ route('register') }}">
         @csrf

         <label for="name" class="form__label">{{ __('Имя') }}
            <input id="name" type="text" class="form__input-text" name="name"
                   value="{{ old('name') }}" required autofocus>
            @error('name')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>

         <label class="form__label" for="division"> {{ __('Подразделение') }}
            <select class="form__select" name="division">
               @if( old('division'))
                  <option value="{{ old('division') }}">{{ $division->find(old('division'))->title }}</option>
               @else
                  <option class="form__option" value="title" disabled selected> Выберите подразделение</option>
               @endif
               @foreach( $division as $div)
                  <option value="{{ $div->id }}"> {{ $div->title }} </option>
               @endforeach
            </select>
            @error('division_id')
            <span class="error">*{{ $message }}</span>
            @enderror
         </label>

         <label class="form__label" for="role"> {{ __('Роль пользователя') }}
            <select class="form__select" name="role">
               @if(old('role'))
                  <option value="{{ old('role') }}"> {{ old('role') }} </option>
               @else
                  <option class="form__option" value="title" disabled selected> Выберите роль пользователя</option>
                  <option value="user"> user</option>
                  <option value="moderator"> moderator</option>
                  <option value="admin"> admin</option>
               @endif
            </select>
            @error('role')
            <span class="error">*{{ $message }}</span>
            @enderror
         </label>

         <label for="phone" class="form__label">{{ __('Номер мобильного телефона') }}
            <input id="phone" type="tel" class="form__input-text"
                   name="phone" value="{{ old('phone') }}"
                   required placeholder="Введите номер в формате 8-999-888-77-66"
                   pattern="[0-9]{1}-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}">
            @error('phone')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>

         <label for="email" class="form__label">{{ __('Адрес электронной почты (СЭП)') }}
            <input id="email" type="email" class="form__input-text"
                   name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>

         <label for="password" class="form__label">{{ __('Пароль') }}
            <input id="password" type="password" class="form__input-text"
                   name="password" required>
            @error('password')
            <span class="error" role="alert">*{{ $message }}</span>
            @enderror
         </label>

         <label for="password-confirm"
                class="form__label">{{ __('Подтверждение пароля') }}
            <input id="password-confirm" type="password" class="form__input-text" name="password_confirmation"
                   required>
         </label>

         <button type="submit" class="form__btn-submit">
            {{ __('Регистрация') }}
         </button>
      </form>
      <button class="button button--mt">
         <a href="{{ url()->previous() }}"> Назад</a>
      </button>
   </div>

@endsection
