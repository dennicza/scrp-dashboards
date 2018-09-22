$(document).ready(function() {
   $('#go2register').on('click', function() {
       window.location.assign('/register/');
   });

   $('#login').on('click', function() {
        var obj = $('.form-control');
        var param = 'login=1' + Array.prototype.reduce.call(obj, function(msg, item) {
            return msg += "&" + $(item).attr('id') + "=" + $(item).val();
        }, "");
// console.log(param);

        $.ajax({
            url: "ajax.php",
            type: "POST",
            dataType: "html",
            data: param,

            success: function(data){
console.log (data);
                
                if (!data) {
                    alert ("Виникла помилка авторизації\n\nКористувача з такими даними в системі не зареєстровано");
                } else 
                if (data > 0) {
                    window.location.assign (window.location.protocol + '//' + window.location.hostname);
                } else {
                    alert ("Виникла помилка авторизації\n\nЗв'яжіться з адміністратором системи");
                }
            },
    
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });
    });
});
