$(document).ready(function() {
    $('#logout').on('click', function() {
        logOut ();
    });

    $('.btn-link').on('click', function() {
        var lnk = $(this).attr('id').replace(/-/g, '/');
        if (lnk.search('/') != -1) lnk += '.php';
        window.location.assign (window.location.protocol + '//' + window.location.hostname + '/' + lnk);
    });
});

function logOut () {
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "html",
        data: {logout : 1},

        success: function(data){             
            if (data) {
                window.location.assign (window.location.protocol + '//' + window.location.hostname + '/login/');
            } else {
                alert ("Виникла помилка\n\nЗв'яжіться з адміністратором системи");
            }
        },

        error: function(error){
            console.log("Error:");
            console.log(error);
        }
    });
}