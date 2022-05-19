<table>
   <thead>
   <tr>
      <th
         colspan="14" style="text-align: center">{{ 'Задержания ГИБДД с ' . $dates[0] . ' до ' . $dates[1] }}
      </th>
   </tr>
   <tr>
      <th style="font-weight: 700; text-align: center; width: 400px">Вид задержания</th>
      @for($i=1; $i<=12; $i++)

         <th style="font-weight: 700; text-align: center">{{ $month[$i] }}</th>

      @endfor
      <th style="font-weight: 700; text-align: center; width: 120px">Общий итог</th>
   </tr>
   </thead>
   <tbody>
   @foreach($uniqType as $type )
      <tr>
         <td>
            {{ $type->title }}
         </td>

         @for($i=1; $i<=12; $i++)
            <td>
               @if($detention-> toQuery()-> where('type_id', $type-> id)-> whereMonth('date',$i)->exists())
                  {{ $detention-> toQuery()-> where('type_id', $type-> id)-> whereMonth('date',$i)-> count() }}
               @endif
            </td>
         @endfor

         <td>
            {{ $detention-> toQuery()-> where('type_id', $type-> id)-> count() }}
         </td>
      </tr>

   @endforeach
   <tr>
      <td>Всего</td>
      @for($i=1; $i<=12; $i++)
         <td>
            @if($detention-> toQuery()->  whereMonth('date',$i)->exists())
               {{ $detention-> toQuery()->  whereMonth('date',$i)-> count() }}
            @endif
         </td>
      @endfor
      <td>{{ $detention-> count()}}</td>
   </tr>

   </tbody>
</table>

