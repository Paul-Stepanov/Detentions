<table>
   <thead>
   <tr>
      <th style=" text-align: center;font-weight: 700; width: 35px; height: 70px">ID</th>
      <th style=" text-align: center;font-weight: 700; width: 60px">КУСП</th>
      <th style=" text-align: center;font-weight: 700; width: 95px">Дата</th>
      <th style=" text-align: center;font-weight: 700; width: 150px">Подразделение</th>
      <th style=" text-align: center;font-weight: 700; width: 180px">Вид задержания</th>
      <th style=" text-align: center;font-weight: 700; width: 1070px">Описание</th>
      <th style=" text-align: center;font-weight: 700; width: 110px">Примечание</th>
      <th style=" text-align: center;font-weight: 700; width: 150px; word-wrap: break-word">Основания прекращения
         регистрации
      </th>
   </tr>
   </thead>
   <tbody>
   @foreach($detentions as $detention)
      <tr>
         <td style="word-wrap: break-word">{{ $detention->id }}</td>
         <td style="word-wrap: break-word">{{ $detention->kusp }}</td>
         <td style="word-wrap: break-word">{{ $detention->date->format('d.m.Y') }}</td>
         <td style="word-wrap: break-word">{{ $detention->division->title }}</td>
         <td style="word-wrap: break-word">{{ $detention->type->title }}</td>
         <td style="word-wrap: break-word; text-align: justify">{{ $detention->description }}</td>
         <td style="word-wrap: break-word">{{ $detention->explanation }}</td>
         <td style="word-wrap: break-word">@isset($detention->note->title) {{  $detention->note->title }} @endisset</td>
      </tr>
   @endforeach
   </tbody>
</table>
