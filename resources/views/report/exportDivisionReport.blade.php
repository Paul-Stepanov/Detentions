<table>
   <thead>
   <tr>
      <th
         colspan="{{$uniqDivision->count() +2 }}"
         style="text-align: center">{{ 'Задержания ГИБДД с ' . $dates[0] . ' до ' . $dates[1] }}
      </th>
   </tr>
   <tr>
      <th style="font-weight: 700; text-align: center; width: 400px; height: 80px">Вид задержания</th>
      @foreach($uniqDivision as $division)
         <th style="word-wrap: break-word; text-align: center">{{ $division->title }}</th>
      @endforeach
      <th>Всего</th>
   </tr>
   </thead>
   <tbody>
   @foreach($uniqType as $type)
      <tr>
         <td>
            {{ $type->title }}
         </td>
         @foreach($uniqDivision as $division)
            @if($detention-> toQuery() -> where('division_id', $division->id)-> where('type_id', $type->id)-> exists() )
               <td>{{ $detention-> toQuery() -> where('division_id', $division->id)-> where('type_id', $type->id)-> count() }}</td>
            @else
               <td></td>
            @endif
         @endforeach
         <th>{{ $detention-> toQuery() -> where('type_id', $type->id)-> count() }}</th>
      </tr>
   @endforeach
   <tr>
      <th>Всего</th>
      @foreach($uniqDivision as $division)
         <th>{{ $detention-> toQuery() -> where('division_id', $division->id)-> count() }}</th>
      @endforeach
      <th>{{ $detention-> count() }}</th>
   </tr>
   </tbody>
</table>
