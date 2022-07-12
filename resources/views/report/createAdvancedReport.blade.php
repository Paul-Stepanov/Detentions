@extends('layouts.mainLayout')

@section('title', 'Расширенный отчет')

@section('content')
   <form class="form" name="advancedReportForm" id="advancedReportForm"
         action={{route('report.createAdvancedReport')}} method="post">
      @csrf
      <h1 class="title">Формирования расширенного отчета</h1>
      <br>
      <div class="advanced-report__wrapper">
         <div class="advanced-report__inner">
            <div class="advanced-report__card advanced-report__card--date">
               <p class="advanced-report__subtitle"> Период задержания: </p>
               <label> с:
                  <input class="advanced-report__card-item" type="date" name="date_start" id="date_start"
                         value="{{old('date_start')}}">
               </label>
               <label>по:
                  <input class="advanced-report__card-item" type="date" name="date_end" id="date_end"
                         value="{{old('date_end')}}">
               </label>
            </div>
            <div class="advanced-report__card advanced-report__card--date">
               <p class="advanced-report__subtitle"> Период создания записи: </p>
               <label> с:
                  <input class="advanced-report__card-item" type="date" name="date_create_start" id="date_create_start"
                         value="{{old('date_create_start')}}"
                  >
               </label>
               <label>по:
                  <input class="advanced-report__card-item" type="date" name="date_create_end" id="date_create_end"
                         value="{{old('date_create_end')}}">
               </label>
            </div>
            <div class="advanced-report__card advanced-report__card--date">
               <p class="advanced-report__subtitle"> Период обновления записи: </p>
               <label> с:
                  <input class="advanced-report__card-item" type="date" name="date_edit_start" id="date_edit_start"
                         value="{{old('date_edit_start')}}">
               </label>
               <label>по:
                  <input class="advanced-report__card-item" type="date" name="date_edit_end" id="date_edit_end"
                         value="{{old('date_edit_end')}}">
               </label>
            </div>
         </div>
         <div class="advanced-report__inner">
            @if(auth()->user()->role == 'admin' or auth()->user()->role == 'moderator')
               <div class="advanced-report__card">
                  <p class="advanced-report__subtitle"> Подразделение:</p>
                  <div class="advanced-report__card-items">
                     <label class="advanced-report__card-item-label">
                        <input type="checkbox" name="division" id="allDivision"> Все
                     </label>
                     @foreach($division as $div)
                        <label class="advanced-report__card-item-label">
                           <input class="advanced-report__card-item" type="checkbox" name="division[]"
                                  value="{{$div->id}}">{{$div->title}}
                        </label>
                     @endforeach
                  </div>
               </div>
            @endif

            <div class="advanced-report__card">
               <p class="advanced-report__subtitle"> Вид задержания:</p>
               <div class="advanced-report__card-items">
                  <label class="advanced-report__card-item-label">
                     <input type="checkbox" name="type" id="allType"> Все
                  </label>
                  @foreach($type as $t)
                     <label class="advanced-report__card-item-label">
                        <input class="advanced-report__card-item" type="checkbox" name="type[]"
                               value="{{$t->id}}">{{$t->title}}
                     </label>
                  @endforeach
               </div>
            </div>

            <div class="advanced-report__card">
               <p class="advanced-report__subtitle"> Основания прекращения регистрации:</p>
               <div class="advanced-report__card-items">
                  <label class="advanced-report__card-item-label">
                     <input type="checkbox" name="note" id="allNote"> Все
                  </label>
                  @foreach($note as $n)
                     <label class="advanced-report__card-item-label">
                        <input class="advanced-report__card-item" type="checkbox" name="note[]"
                               value="{{$n->id}}">{{$n->title}}
                     </label>
                  @endforeach
               </div>
            </div>

            <div class="advanced-report__card">
               <p class="advanced-report__subtitle"> Пользователь создавший запись:</p>
               <div class="advanced-report__card-items">
                  <label class="advanced-report__card-item-label">
                     <input type="checkbox" name="user" id="allUser"> Все
                  </label>
                  @foreach($user as $u)
                     <label class="advanced-report__card-item-label">
                        <input class="advanced-report__card-item" type="checkbox" name="user[]"
                               value="{{$u->id}}">{{$u->name}}
                     </label>
                  @endforeach
               </div>
            </div>
         </div>
         <div class="advanced-report__inner">
            <div class="advanced-report__card">
               <label class="advanced-report__card-item-label advanced-report__subtitle"> КУСП:
                  <input class="advanced-report__card-item" type="number" name="kusp" id="kusp">
               </label>
            </div>

            <div class="advanced-report__card">
               <label class="advanced-report__card-item-label advanced-report__subtitle"> Описание содержит:</label>
               <textarea class="advanced-report__card-item" name="description" id="description"></textarea>
            </div>

            <div class="advanced-report__card">
               <label class="advanced-report__card-item-label advanced-report__subtitle"> Примечание
                  содержит:</label>
               <textarea class="advanced-report__card-item" name="explanation" id="explanation"></textarea>
            </div>
         </div>
      </div>

      <button class="button button--mt" id="generateReportButton"> Сформировать отчет</button>

   </form>

   <script src="{{asset('js/addSelectAdvancedReport.js')}}"></script>
   <script src="{{asset('js/addRequiredDate.js')}}"></script>
@endsection
