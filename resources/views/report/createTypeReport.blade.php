<form class="report__type-form" action="{{ route('report.createTypeReport') }}" method="POST">
   @csrf
   <label class="report__type-form-label" for="date_start">Начальная дата:
      @error('date_start')
      <p class="error">*{{ $message }}</p>
      @enderror
   </label>
   <input class="report__type-form-input" type="date" name="date_start" id="date_start" value="{{ old('date_start') }}">

   <label class="report__type-form-label" for="date_end">Конечная дата:
      @error('date_end')
      <p class="error">*{{ $message }}</p>
      @enderror
   </label>
   <input class="report__type-form-input" type="date" name="date_end" id="date_end" value="{{ old('date_end') }}">

   <button class="form__btn-submit report__type-form-btn" type="submit">Ok</button>
</form>

