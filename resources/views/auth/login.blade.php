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
      <br>
      <div class="form form__downloads">
         <div class="form__downloads-item">
            <p class="alert__attention">В случае некорректной работы сайта, обновите свой браузер, скачав любой из
               предложенных ниже, с учетом разрядности Вашей операционной системы!</p>
         </div>

         <div class="form__downloads-item">
            <a class="form__downloads-link" href="{{ asset('browsers/Firefox Setup 102.0.1(32).exe') }}">
               <img class="form__downloads-img" src="{{ asset('img/icons/firefox.png') }}" alt="firefox32">
               <p class="form__downloads-description">Mozilla FireFox 32x</p>
            </a>
            <a class="form__downloads-link" href="{{ asset('browsers/Firefox Setup 102.0.1(64).exe') }}">
               <img class="form__downloads-img" src="{{ asset('img/icons/firefox.png') }}" alt="firefox64">
               <p class="form__downloads-description">Mozilla FireFox 64x</p>
            </a>
            <a class="form__downloads-link" href="{{ asset('browsers/ChromeStandaloneSetup32.exe') }}">
               <img class="form__downloads-img" src="{{ asset('img/icons/chrome.png') }}" alt="chrome32">
               <p class="form__downloads-description">Google Chrome 32x</p>
            </a>
            <a class="form__downloads-link" href="{{ asset('browsers/ChromeStandaloneSetup64.exe') }}">
               <img class="form__downloads-img" src="{{ asset('img/icons/chrome.png') }}" alt="chrome64">
               <p class="form__downloads-description">Google Chrome 64x</p>
            </a>
         </div>
      </div>
   </div>
@endsection
