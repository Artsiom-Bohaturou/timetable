$(function () {
    $(".dataTable").DataTable({
        "info": false,
    });
});

document.querySelector('#tableList')
    .addEventListener('click', (e) => {
        window.location = e.target.closest('.clickable-row').getAttribute('data-href');
    });

