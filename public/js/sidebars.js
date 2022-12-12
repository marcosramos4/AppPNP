/* global bootstrap: false */
(() => {
  'use strict'
  const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(tooltipTriggerEl => {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })
})();

function nuevoReg(id){
    console.log(id);
    document.getElementById(id).style.display='block';
}

function cerrReg(id){
    document.getElementById(id).style.display='none';
}
