@extends('layouts.mainLayout')

@section('content')
   <div class="form__container form__container--auth">
      <div class="title">{{ __('Авторизация') }}</div>

      <form class="form" method="POST" action="{{ route('login') }}">
         @csrf

         <label for="email" class="form__label">{{ __('Адрес электронной почты (СЭП)') }}

            <input id="email" type="email" class="form__input-text"
                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="error" role="alert">
                                        <strong>*{{ $message }}</strong>
                                    </span>
            @enderror
         </label>
         <label for="password" class="form__label">{{ __('Пароль') }}

            <input id="password" type="password"
                   class="form__input-text" name="password" required
                   autocomplete="current-password">

            @error('password')
            <span class="error" role="alert">
                                        <strong>*{{ $message }}</strong>
                                    </span>
            @enderror
         </label>


         <label class="form__label" for="remember">
            {{ __('Запомнить меня') }}
            <input class="form__input-check" type="checkbox" name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>
         </label>

         <button type="submit" class="form__btn-submit">
            {{ __('Вход') }}
         </button>
      </form>

   </div>
@endsection
