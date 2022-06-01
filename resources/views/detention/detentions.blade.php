@extends('layouts.mainLayout')

@section('title', 'Задержания')

@section('content')

   <h1 class="title">Задержания</h1>
   <button class="detentions__button-create button">
      <a href=" {{ route('detention.create') }}"> Создать новую запись</a>
   </button>

   <button class="button report__menu-wrapper" id="reportMenu" onclick="showReportMenu(this)">
      Сформировать отчет
      <a class="report__menu-link report__menu-link--hide" id="typeReport" href="{{ route('report.showTypeReport') }}">по
         виду</a>
      <a class="report__menu-link report__menu-link--hide" id="divisionReport"
         href="{{ route('report.showDivisionReport') }}">по подразделениям</a>
      <a class="report__menu-link report__menu-link--hide" id="advancedReport" href="#">расширенный</a>
   </button>

   <div class="detentions">
      <div class="detentions__card">
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'kusp', 'sorted'=>'desc']) }}">КУСП:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'kusp', 'sorted'=>'asc']) }}">КУСП:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'kusp', 'sorted'=>'asc']) }}">КУСП:</a>
            @endif
         </p>
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'date', 'sorted'=>'desc']) }}">Дата:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'date', 'sorted'=>'asc']) }}">Дата:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'date', 'sorted'=>'asc']) }}">Дата:</a>
            @endif
         </p>
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'division_id', 'sorted'=>'desc']) }}">Подразделение:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'division_id', 'sorted'=>'asc']) }}">Подразделение:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'division_id', 'sorted'=>'asc']) }}">Подразделение:</a>
            @endif
         </p>
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'type_id', 'sorted'=>'desc']) }}">Вид задержания:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'type_id', 'sorted'=>'asc']) }}">Вид задержания:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'type_id', 'sorted'=>'asc']) }}">Вид задержания:</a>
            @endif
         </p>
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'description', 'sorted'=>'desc']) }}">Описание:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'description', 'sorted'=>'asc']) }}">Описание:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'description', 'sorted'=>'asc']) }}">Описание:</a>
            @endif
         </p>
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'explanation', 'sorted'=>'desc']) }}">Примечание:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'explanation', 'sorted'=>'asc']) }}">Примечание:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'explanation', 'sorted'=>'asc']) }}">Примечание:</a>
            @endif
         </p>
         <p class="detentions__card-title">
            @if(isset($sorted))
               @switch($sorted)
                  @case('asc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'note_id', 'sorted'=>'desc']) }}">Основания
                     прекращения регистрации:</a>
                  @break
                  @case('desc')
                  <a href="{{ route('sort.sortColumn', ['column'=>'note_id', 'sorted'=>'asc']) }}">Основания прекращения
                     регистрации:</a>
                  @break
               @endswitch
            @else
               <a href="{{ route('sort.sortColumn', ['column'=>'note_id', 'sorted'=>'asc']) }}">Основания прекращения
                  регистрации:</a>
            @endif
         </p>
      </div>

      @foreach($detention->map(function ($value, $index){
                if ($value->edit_detentions->count()>0){
                    return $value->edit_detentions->last();
                } else{
                    return $value;
                }}) as $det)

         <div class="detentions__card" id="detentionsCard" onclick="showEditMenu(this)">
            <p class="detentions__card-item">
               {{ $det->kusp }}
            </p>
            <p class="detentions__card-item">
               {{ $det->date->format('d.m.Y') }}
            </p>
            <p class="detentions__card-item">
               {{ $det->division->title }}
               @if($det->editing or $det->detention_id)
                  <span class="error">Запись отредактирована и ждет утверждения</span>
               @elseif($det->deleting)
                  <span class="error">Запись удалена и ждет утверждения</span>
               @endif
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
               @if(auth()->user()->role == 'admin')

                  <a class="detentions__edit-block-item button__edit"
                     @if($det->detention_id)
                     href="{{ route('detention.edit', ['detention'=>$det->detention_id]) }}">
                     @else
                        href="{{ route('detention.edit', ['detention'=>$det->id]) }}">
                     @endif
                     <img class="button__edit-img" src="{{asset('img/icons/edit-button.png')}}" alt="редактировать">
                  </a>
                  <form class="detentions__edit-block-item"
                        @if($det->detention_id)
                        action="{{ route('detention.destroy', ['detention'=>$det->detention_id] )}}"
                        @else
                        action="{{ route('detention.destroy', ['detention'=>$det->id] )}}"
                        @endif
                        method="post">
                     @csrf
                     @method('DELETE')
                     <button class="button__delete">
                        <img class="button__delete-img" src="{{asset('img/icons/delete-button.png')}}" alt="удалить">
                     </button>
                  </form>
               @else
                  <a class="detentions__edit-block-item button__edit"
                     @if($det->detention_id)
                     href="{{ route('editDetention.userEdit', ['detention'=>$det->detention_id]) }}">
                     @else
                        href="{{ route('editDetention.userEdit', ['detention'=>$det->id]) }}">
                     @endif
                     <img class="button__edit-img" src="{{asset('img/icons/edit-button.png')}}" alt="редактировать">
                  </a>
                  <form class="detentions__edit-block-item"
                        @if($det->detention_id)
                        action="{{ route('editDetention.userDelete', ['detention'=>$det->detention_id] )}}"
                        @else
                        action="{{ route('editDetention.userDelete', ['detention'=>$det->id] )}}"
                        @endif
                        method="post">
                     @csrf
                     <button class="button__delete">
                        <img class="button__delete-img" src="{{asset('img/icons/delete-button.png')}}" alt="удалить">
                     </button>
                  </form>
               @endif
            </div>
         </div>
      @endforeach
   </div>
   {{ $detention->links() }}
   <a class="button" href="{{ route('detention.export') }}">Экспорт в Excel</a>

   @if(auth()->user()->role == 'admin')
      <a class="button" href="{{ route('detention.import') }}">Импорт из Excel</a>
   @endif
   <script src="{{asset('js/showReportMenu.js')}}"></script>
   <script src="{{asset('js/editDetentionMenu.js')}}"></script>
@endsection
