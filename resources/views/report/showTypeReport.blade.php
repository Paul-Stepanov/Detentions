@extends('layouts.mainLayout')

@section('title', 'Отчет по виду задержания')

@section('content')

   <div class="report__type-container">

      @include('report.createTypeReport')

      @isset($detention)
         @if( $detention->isEmpty())
            <div class="error">Поиск не дал результатов</div>
         @else
            <h1 class="title">Отчет по виду задержания</h1>

            <div class="report-type__card">
               <div class="report-type__title">{{ 'Задержания ГИБДД с ' . $dates[0] . ' до ' . $dates[1] }}</div>
               <div class="report-type__subtitle">Вид задержания</div>
               @for($i=1; $i<=12; $i++)
                  <div class="report-type__subtitle">{{ $month[$i] }}</div>
               @endfor
               <div class="report-type__subtitle">Общий итог</div>
               @foreach($uniqType as $type )
                  <div class="report-type__item report-type__item--left-text">{{ $type->title }}</div>
                  @for($i=1; $i<=12; $i++)
                     <div class="report-type__item">
                        @if($detention-> toQuery()-> where('type_id', $type-> id)-> whereMonth('date',$i)->exists())
                           {{ $detention-> toQuery()-> where('type_id', $type-> id)-> whereMonth('date',$i)-> count() }}
                        @endif
                     </div>
                  @endfor
                  <div
                     class="report-type__item report-type__item--total">{{ $detention-> toQuery()-> where('type_id', $type-> id)-> count() }}
                  </div>
               @endforeach
               <div class="report-type__total report-type__item--left-text">Всего</div>
               @for($i=1; $i<=12; $i++)
                  <div class="report-type__total">
                     @if($detention-> toQuery()->  whereMonth('date',$i)->exists())
                        {{ $detention-> toQuery()->  whereMonth('date',$i)-> count() }}
                     @endif
                  </div>
               @endfor
               <div class="report-type__total">{{ $detention-> count()}}</div>
            </div>

            <a class="button report-type__btn" href="{{ route('report.typeExport') }}">Экспорт в Excel</a>
         @endif
      @endisset
   </div>

@endsection
