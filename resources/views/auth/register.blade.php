@extends('layouts.mainLayout')

@section('content')
   <div class="form__container form__container--auth">
      <div class="title">{{ __('Регистрация') }}</div>

      <form class="form" method="POST" action="{{ route('register') }}">
         @csrf

         <label for="name" class="form__label">{{ __('Имя') }}

            <input id="name" type="text" class="form__input-text" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="error" role="alert">
                                        <strong>*{{ $message }}</strong>
                                    </span>
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
            @error('division')
            <span class="error">*{{ $message }}</span>
            @enderror
         </label>

         <label for="email" class="form__label">{{ __('Адрес электронной почты (СЭП)') }}

            <input id="email" type="email" class="form__input-text"
                   name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="error" role="alert">
                                        <strong>*{{ $message }}</strong>
                                    </span>
            @enderror
         </label>
         <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}

            <input id="password" type="password" class="form__input-text"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="error" role="alert">
                                        <strong>*{{ $message }}</strong>
                                    </span>
            @enderror
         </label>

         <label for="password-confirm"
                class="form__label">{{ __('Подтверждение пароля') }}

            <input id="password-confirm" type="password" class="form__input-text" name="password_confirmation"
                   required autocomplete="new-password">
         </label>

         <button type="submit" class="form__btn-submit">
            {{ __('Регистрация') }}
         </button>
      </form>
   </div>
@endsection
