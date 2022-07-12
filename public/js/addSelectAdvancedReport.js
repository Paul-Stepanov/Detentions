'use strict'

let allDivisionSelect = document.querySelector('#allDivision');
let allTypeSelect = document.querySelector('#allType');
let allNoteSelect = document.querySelector('#allNote');
let allUserSelect = document.querySelector('#allUser');

function selectAll(event) {
   let name = event.target.name;
   let inputs = document.querySelectorAll(`[name = ${name}\\[\\]]`);
   if (event.target.checked) {
      inputs.forEach(el => el.checked = true)
   } else {
      inputs.forEach(el => el.checked = false)
   }
}

if (allDivisionSelect) {
   allDivisionSelect.addEventListener('change', selectAll);
}
if (allUserSelect) {
   allUserSelect.addEventListener('change', selectAll);
}
allTypeSelect.addEventListener('change', selectAll);
allNoteSelect.addEventListener('change', selectAll);
