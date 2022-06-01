@extends('layouts.mainLayout')

@section('title', 'Отчет по подразделениям')

@section('content')

   <div class="report__division-container">

      @include('report.createDivisionReport')

      @isset($detention)
         @if( $detention->isEmpty())
            <div class="error">Поиск не дал результатов</div>
         @else
            <h1 class="title">Отчет по задержаниям подразделений</h1>

            <div style="display: grid; grid-template-columns: 25% repeat({{$column}}, 1fr) 5%"
                 class="report-division__table">
               <div class="report-division__title" style="grid-column: 1/{{$column+3}}">
                  {{ 'Задержания ГИБДД с ' . $dates[0] . ' до ' . $dates[1] }}
               </div>
               <div class="report-division__subtitle">Вид задержания</div>
               @foreach($uniqDivision as $division)
                  <div
                     class="report-division__subtitle report-division__subtitle--column-name">{{ $division->title }}</div>
               @endforeach
               <div class="report-division__subtitle">Всего</div>
               @foreach($uniqType as $type)
                  <div class="report-division__item report-division__item--left-text">
                     {{ $type->title }}
                  </div>
                  @foreach($uniqDivision as $division)
                     @if($detention-> toQuery() -> where('division_id', $division->id)-> where('type_id', $type->id)-> exists() )
                        <div
                           class="report-division__item">{{ $detention-> toQuery() -> where('division_id', $division->id)-> where('type_id', $type->id)-> count() }}</div>
                     @else
                        <div class="report-division__item"></div>
                     @endif
                  @endforeach
                  <div
                     class="report-division__subtitle">{{ $detention-> toQuery() -> where('type_id', $type->id)-> count() }}</div>
               @endforeach
               <div class="report-division__total">Всего</div>
               @foreach($uniqDivision as $division)
                  <div
                     class="report-division__total">{{ $detention-> toQuery() -> where('division_id', $division->id)-> count() }}</div>
               @endforeach
               <div class="report-division__total">{{ $detention-> count() }}</div>
            </div>

            <a class="button report-division__btn" href="{{ route('report.divisionExport') }}">Экспорт в Excel</a>
         @endif
      @endisset
   </div>

@endsection
