'use strict'

let reportLinks = document.querySelectorAll('.report__menu-link');
let typeReport = document.querySelector('#typeReport');
let divisionReport = document.querySelector('#divisionReport');
let advancedReport = document.querySelector('#advancedReport');

function showReportMenu(el) {
   reportLinks.forEach(element => element.classList.toggle('report__menu-link--hide'));
   if (reportLinks.classList !== 'report__menu-link--hide') {
      typeReport.classList.toggle('type-report-btn')
      divisionReport.classList.toggle('division-report-btn')
      advancedReport.classList.toggle('advanced-report-btn')
   }

}


