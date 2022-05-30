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
                  @unless($changed->edit_kusp == $det->kusp)
                     {{ $changed->edit_kusp }}
                     <input type="number" name="kusp" value="{{ $changed->edit_kusp }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">

                  @unless($changed->edit_date == $det->date)
                     {{ $changed->edit_date->format('d.m.Y') }}
                     <input type="text" name="date" value="{{ $changed->edit_date }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  @unless($changed->edit_division_id == $det->division_id)
                     {{ $changed->division->title }}
                     <input type="text" name="division_id" value="{{ $changed->edit_division_id }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  @unless($changed->edit_type_id == $det->type_id)
                     {{ $changed->type->title }}
                     <input type="text" name="type_id" value="{{ $changed->edit_type_id }}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--left-text detentions__card-item--changed">
                  @if(array_diff(explode(' ',$changed->edit_description),explode(' ',$det->description)) !=[] or $changed->edit_description != $det->description)
                     {{ $changed->edit_description }}
                     <input type="text" name="description" value="{{$changed->edit_description}}" hidden>
                     <span
                        class="alert__changes">Изменения: {{ implode(' ; ',array_diff(explode(' ',$changed->edit_description),explode(' ',$det->description)))}}</span>
                  @endif
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  @unless($changed->edit_explanation == $det->explanation)
                     {{ $changed->edit_explanation }}
                     <input type="text" name="explanation" value="{{$changed->edit_explanation}}" hidden>
                  @endunless
               </p>
               <p class="detentions__card-item detentions__card-item--changed">
                  @isset($changed->edit_note_id)
                     @unless($changed->edit_note_id == $det->note_id)
                        {{  $changed->note->title }}
                        <input type="text" name="note_id" value="{{$changed->edit_note_id}}" hidden>
                     @endunless
                  @endisset
               </p>
               <button class="button__confirm" type="submit">Утвердить изменения</button>
            </form>
         @endforeach
      </div>

   @endforeach


@endsection
