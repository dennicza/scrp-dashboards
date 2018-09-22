$(document).ready(function(){
    tableRows ();
    $('#pages').change(function() {
        window.location.assign(window.location.href.replace(/p=[\d]*/, 'p=' + $(this).val()));
    });
});
