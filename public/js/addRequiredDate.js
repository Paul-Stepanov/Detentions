'use strict'

let generateReportButton = document.querySelector('#generateReportButton')
let dateStart = document.querySelector('#date_start')
let dateEnd = document.querySelector('#date_end')
let dateCreateStart = document.querySelector('#date_create_start')
let dateCreateEnd = document.querySelector('#date_create_end')
let dateEditStart = document.querySelector('#date_edit_start')
let dateEditEnd = document.querySelector('#date_edit_end')


function addRequiredDate() {
   if (!dateStart.value && !dateEnd.value && !dateCreateStart.value && !dateCreateEnd.value && !dateEditStart.value && !dateEditEnd.value) {
      dateStart.setAttribute('required', '');
      dateEnd.setAttribute('required', '');
   } else {
      dateStart.removeAttribute('required');
      dateEnd.removeAttribute('required');
   }
}

generateReportButton.addEventListener('click', addRequiredDate)
