$(document).ready(function(){
    tableRows ();

    $('#import').click(function(){
       window.location.assign (window.location.protocol + '//' + window.location.hostname + '/bindings/import.php');
    });

    $('#template').click(function(){
        window.location.assign (window.location.protocol + '//' + window.location.hostname + '/bindings/uploads/bindings.xls');
     });
});
