<table>
   <thead>
   <tr>
      <th style="text-align: center;font-weight: 700; width: 35px; height: 70px">ID</th>
      <th style="text-align: center;font-weight: 700; width: 60px">КУСП</th>
      <th style="text-align: center;font-weight: 700; width: 95px">Дата</th>
      <th style="text-align: center;font-weight: 700; width: 150px">Подразделение</th>
      <th style="text-align: center;font-weight: 700; width: 180px">Вид задержания</th>
      <th style="text-align: center;font-weight: 700; width: 1070px">Описание</th>
      <th style="text-align: center;font-weight: 700; width: 110px">Примечание</th>
      <th style="text-align: center;font-weight: 700; width: 150px; word-wrap: break-word">Основания прекращения регистрации</th>
   </tr>
   </thead>
   <tbody>
   @foreach($detention as $det)
      <tr>
         <td style="word-wrap: break-word">{{ $det->id }}</td>
         <td style="word-wrap: break-word">{{ $det->kusp }}</td>
         <td style="word-wrap: break-word">{{ $det->date->format('d.m.Y') }}</td>
         <td style="word-wrap: break-word">{{ $det->division->title }}</td>
         <td style="word-wrap: break-word">{{ $det->type->title }}</td>
         <td style="word-wrap: break-word; text-align: justify">{{ $det->description }}</td>
         <td style="word-wrap: break-word">{{ $det->explanation }}</td>
         <td style="word-wrap: break-word">@isset($det->note->title) {{  $det->note->title }} @endisset</td>
      </tr>
   @endforeach
   </tbody>
</table>

