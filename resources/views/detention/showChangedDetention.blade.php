@extends('layouts.mainLayout')

@section('title', 'Утверждение отредактированных записей')

@section('content')

   @foreach($detentions as $det)

      <div class="detentions__card-wrapper">
         <p class="detentions__card-item detentions__card-item--changed">
            {{ $serialNumber++ }}
         </p>
         <div class="detentions__card" id="detentionsCard">
            <p class="detentions__card-item detentions__card-item--changed">
               {{ $det->kusp }}
            </p>
            <p class="detentions__card-item detentions__card-item--changed">
               {{ $det->date->format('d.m.Y') }}
            </p>
            <p class="detentions__card-item detentions__card-item--changed">
               {{ $det->division->title }}
               @if($det->editing)
                  <span class="error">Запись отредактирована и ждет утверждения</span>
               @endif
            </p>
            <p class="detentions__card-item detentions__card-item--changed">
               {{ $det->type->title }}
            </p>
            <p class="detentions__card-item detentions__card-item--left-text detentions__card-item--changed">
               {{ $det->description }}
            </p>
            <p class="detentions__card-item detentions__card-item--changed">
               {{ $det->explanation }}
            </p>
            <p class="detentions__card-item detentions__card-item--changed">
               @isset($det->note->title) {{  $det->note->title }} @endisset
            </p>
         </div>

         @foreach($det->edit_detentions as $changed)

            <form class="detentions__card" id="detentionsCard" method="post"
                  action="{{ route('editDetention.confirmChanges',['editDetention'=>$changed->id] ) }}">
               @csrf
               <p class="detentions__card-item detentions__card-item--changed">
                  {{ $changed->kusp }}
                  @unless($changed->kusp == $det->kusp)
                     <span class="alert__changes">{{ $changed->kusp }}</span>
                     <input type="number" name="kusp" value="{{ $changed->kusp }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  {{ $changed->date->format('d.m.Y') }}
                  @unless($changed->date == $det->date)
                     <span class="alert__changes">{{ $changed->date }}</span>
                     <input type="text" name="date" value="{{ $changed->date }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  {{ $changed->division->title }}
                  @unless($changed->division_id == $det->division_id)
                     <span class="alert__changes">{{ $changed->division->title }}</span>
                     <input type="text" name="division_id" value="{{ $changed->division_id }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  {{ $changed->type->title }}
                  @unless($changed->type_id == $det->type_id)
                     <span class="alert__changes">{{ $changed->type->title }}</span>
                     <input type="text" name="type_id" value="{{ $changed->type_id }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--left-text detentions__card-item--changed">
                  {{ $changed->description }}
                  @if(array_diff(explode(' ',$changed->description),explode(' ',$det->description)) !=[] or $changed->description != $det->description)
                     <input type="text" name="description" value="{{$changed->description}}" hidden>
                     <span
                        class="alert__changes">Изменения: {{ implode(' ; ',array_diff(explode(' ',$changed->description),explode(' ',$det->description)))}}</span>
                  @endif
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  {{ $changed->explanation }}
                  @unless($changed->explanation == $det->explanation)
                     <span class="alert__changes">{{ $changed->explanation }}</span>
                     <input type="text" name="explanation" value="{{$changed->explanation}}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  @isset($changed->note_id)
                     {{  $changed->note->title }}
                     @unless($changed->note_id == $det->note_id)
                        <span class="alert__changes">{{ $changed->note->title }}</span>
                        <input type="text" name="note_id" value="{{$changed->note_id}}" hidden>
                     @endunless
                  @endisset
               </p>
               <button class="button__confirm" type="submit">Утвердить изменения</button>
            </form>
         @endforeach
      </div>

   @endforeach


@endsection
