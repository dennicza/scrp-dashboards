$(document).ready(function() {
    var arr = window.location.pathname.split("/");
    var el = $('#'+arr[1]);
    if (el) el.addClass('active');

//    console.log(arr[1]);

    $('#logout').on('click', function() {
        logOut ();
        event.preventDefault();
    });
});

function logOut () {
    $.ajax({
        url: "../ajax.php",
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