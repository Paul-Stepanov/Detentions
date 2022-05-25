'usr strict'

function noteSelect(typeSelect) { // при нажатии на селект выбора вида задержания, в случае если видом является гос.рег.знаки в розыске, отображается инпут основания для прекращения регистрации
   let noteSelectLabel = document.querySelector('#noteSelectLabel');
   let optionNoteSelected = document.querySelector('#optionNoteSelected');
   let selectValueNoteChange = document.querySelector('#selectValueNoteChange');
   if (typeSelect.value == 1) {
      noteSelectLabel.classList.remove('detentions__note-select--hide');
      optionNoteSelected.hidden = true;
   } else {
      noteSelectLabel.classList.add('detentions__note-select--hide');
      selectValueNoteChange.value = 'title';
   }
}

function onLoadNoteSelect() { // при загрузке файла скрипта, проверяется вид задержания и если это гос.рег.знаки в розыске, отображается инпут основания для прекращения регистрации
   let noteSelectLabel = document.querySelector('#noteSelectLabel');
   let selectValueNoteChange = document.querySelector('#selectValueNoteChange');
   let typeSelect = document.querySelector('#typeSelect');
   if (typeSelect.value == 1) {
      noteSelectLabel.classList.remove('detentions__note-select--hide')
   } else {
      noteSelectLabel.classList.add('detentions__note-select--hide')
      selectValueNoteChange.value = 'title';
   }
}
