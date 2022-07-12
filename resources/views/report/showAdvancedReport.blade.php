@extends('layouts.mainLayout')

@section('title', 'Расширенный отчет')

@section('content')
   <div class="report__type-container">
      <div class="detentions__card">
         <p class="detentions__card-title"> КУСП:</p>
         <p class="detentions__card-title"> Дата:</p>
         <p class="detentions__card-title"> Подразделение:</p>
         <p class="detentions__card-title"> Вид задержания: </p>
         <p class="detentions__card-title"> Описание:</p>
         <p class="detentions__card-title"> Примечание:</p>
         <p class="detentions__card-title"> Основания прекращения регистрации:</p>
      </div>
      @empty(!$detention)
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
                  <a class="detentions__edit-block-item button__edit"
                     @if($det->detention_id)
                     href="{{ route('detention.show', ['detention'=>$det->detention_id]) }}">
                     @else
                        href="{{ route('detention.show', ['detention'=>$det->id]) }}">
                     @endif
                     <img class="button__edit-img" src="{{asset('img/icons/show-button.png')}}" alt="просмотр">
                  </a>
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
                     <a class="detentions__edit-block-item button__delete"
                        @if($det->detention_id)
                        href="{{ route('editDetention.userDeleteForm', ['detention'=>$det->detention_id]) }}">
                        @else
                           href="{{ route('editDetention.userDeleteForm', ['detention'=>$det->id]) }}">
                        @endif
                        <img class="button__delete-img" src="{{asset('img/icons/delete-button.png')}}"
                             alt="редактировать">
                     </a>
                  @endif
               </div>
            </div>
         @endforeach
      @endempty

      @if($detention->isNotEmpty())
         {{ $detention->links() }}
         <p class="alert__count">Всего записей: {{ $detention->total()}}</p>
      @else
         <span class="error">Поиск не дал результатов</span>
      @endif

   </div>
   <button class="detentions__form-button button">
      <a href="{{ url()->previous() }}"> Назад</a>
   </button>
   <button class="detentions__form-button button">
      <a href="{{ route('report.advancedExport') }}">Экспорт в Excel</a>
   </button>

   <script src="{{asset('js/editDetentionMenu.js')}}"></script>
@endsection
