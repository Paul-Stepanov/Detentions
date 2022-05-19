@extends('layouts.mainLayout')

@section('title', 'Результаты поиска')

@section('search')

   <h1 class="title">Найденные задержания</h1>

   <div class="detentions">
      <div class="detentions__card">
         <p class="detentions__card-title"> КУСП:</p>
         <p class="detentions__card-title"> Дата:</p>
         <p class="detentions__card-title"> Подразделение:</p>
         <p class="detentions__card-title"> Вид задержания: </p>
         <p class="detentions__card-title"> Описание:</p>
         <p class="detentions__card-title"> Примечание:</p>
         <p class="detentions__card-title"> Основания прекращения регистрации:</p>
      </div>
      @foreach($detention as $det)

         <div class="detentions__card" id="detentionsCard" onclick="showEditMenu(this)">
            <p class="detentions__card-item">
               {{ $det->kusp }}
            </p>
            <p class="detentions__card-item">
               {{ $det->date->format('d.m.Y') }}
            </p>
            <p class="detentions__card-item">
               {{ $det->division->title }}
            </p>
            <p class="detentions__card-item">
               {{ $det->type->title }}
            </p>
            <p class="detentions__card-item detentions__card-item--left-text">
               {{ $det->description }}
            </p>
            <p class="detentions__card-item">
               {{ $det->explanation }}
            </p>
            <p class="detentions__card-item">
               @isset($det->note->title) {{  $det->note->title }} @endisset
            </p>

            <div class="detentions__edit-block detentions__edit-block--hide">

               <a class="detentions__edit-block-item button__edit"
                  href="{{ route('detention.edit', ['detention'=>$det->id]) }}">
                  <img class="button__edit-img" src="{{asset('img/icons/edit-button.png')}}" alt="редактировать">
               </a>

               <form class="detentions__edit-block-item"
                     action="{{ route('detention.destroy', ['detention'=>$det->id] )}}"
                     method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="button__delete">
                     <img class="button__delete-img" src="{{asset('img/icons/delete-button.png')}}" alt="удалить">
                  </button>
               </form>
            </div>
         </div>
      @endforeach
   </div>
   @if($detention != [])
      {{ $detention-> links() }}
   @else
      <div class="error">Поиск не дал результатов</div>
   @endif
   <br>
   <a class="button button__search-export" href="{{ route('search.export') }}">Экспорт в Excel</a>

   <script src="{{asset('js/editDetentionMenu.js')}}"></script>

@endsection
