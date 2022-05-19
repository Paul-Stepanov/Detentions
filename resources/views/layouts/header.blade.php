<header class="header">
   <div class="header__logo">
      <img src="{{ asset('/img/logo.png') }}" alt="logo">
   </div>
   <div class="nav">
      @auth
         <a class="nav__menu-item-link" href="{{ route('login') }}">{{ Auth::user() -> name }}</a>
         <a class="nav__menu-item-link" href="{{ route('register') }}">Регистрация</a>
         <a class="nav__menu-item-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            {{ __('Выход') }} </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
         </form>
      @endauth

   </div>
   <nav class="header__nav nav">
      <ul class="nav__menu">
         <li class="nav__menu-item"><a href="{{ route('detention.index') }}" class="nav__menu-item-link">Задержания</a>
         </li>
         <li class="nav__menu-item"><a href="{{ route('division.index') }}" class="nav__menu-item-link">Список
               подразделений</a></li>
         <li class="nav__menu-item"><a href="{{ route('type.index') }}" class="nav__menu-item-link">Виды задержаний</a>
         </li>
         <li class="nav__menu-item"><a href="{{ route('note.index') }}" class="nav__menu-item-link">Основания для
               прекращения
               регистрации ТС</a>
         </li>
         <a class="nav__menu-item nav__menu-item--search" href='{{ route('search.showForm') }}' id="searchButton">
            <span>Поиск</span>
            <img src="{{ asset('img/icons/search-icon.png') }}" alt="search">
         </a>
      </ul>
   </nav>
</header>
