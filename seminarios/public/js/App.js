// const alert = document.getElementById('alert');
// alert.addEventListener('click', () => {
//     // alert('hola');
//     swal(" ¡Hola mundo! ");
// });
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
// var element = document.getElementById('nombres');
var maskOptions = {
    mask: /^[A-Z]+$/i
};
// var mask = IMask(element, maskOptions);
var ele = document.querySelectorAll('#nombres,#paterno,#materno')
ele.forEach(element => {
    IMask(element, maskOptions)
});
IMask(document.getElementById('celular'), { mask: /^[0-9]{1,8}$/ })
IMask(document.getElementById('ci'), { mask: /^[A-Za-z0-9]{1,9}$/ })
var numberMask = IMask(document.getElementById('comple'), {
    mask: /^[0-9A-Za-z]{0,3}$/
});

