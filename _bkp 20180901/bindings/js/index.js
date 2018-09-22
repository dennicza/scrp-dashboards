$(document).ready(function(){
    tableRows ();
    $('#pages').change(function() {
        window.location.assign(window.location.href.replace(/p=[\d]*/, 'p=' + $(this).val()));
    });

    $('#import').click(function(){
       window.location.assign (window.location.protocol + '//' + window.location.hostname + '/bindings/import.php');
    });

    $('#template').click(function(){
        window.location.assign (window.location.protocol + '//' + window.location.hostname + '/bindings/uploads/bindings.xls');
     });
});
