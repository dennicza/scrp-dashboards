$(document).ready(function() {
   $('#cancel').on('click', function() {
       window.location.assign('/login/');
   });

   $('#save').on('click', function() {
        var save_btn = $(this);
        save_btn.prop('disabled', true);

        var obj = $('.form-control');
        var tt = 3000;

        var err = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("input[type='email']").val()));
        err *= Array.prototype.reduce.call(obj, function(res, item) {
            return res *= $(item).val().length;
        }, 1);
// console.log(err);

        if (err) {
            var param = 'saveuser=1' + Array.prototype.reduce.call(obj, function(msg, item) {
                    return msg += "&" + $(item).attr('id') + "=" + $(item).val();
                }, "");
                // }, "").substr(1);
// console.log(param);

            $.ajax({
                url: "ajax.php",
                type: "POST",
                dataType: "html",
                data: param,

                success: function(data){
// console.log (data);
                    
                    if (data == -100) {
                        alert ("Такий e-mail вже використовується\n\nСпробуйте інший варіант");
                        $('#email').focus();
                    } else 
                    if (data > 0) {
                        alert ("Користувача було збережено\n\nНайближчим часом адміністратор розгляне подану заявку");
                        document.location.reload(true);
                    } else {
                        alert ("При збереженні виникла помилка\n\nСпробуйте повторити збереження пізніше");
                    }
                    save_btn.prop('disabled', false);
                },
        
                error: function(error){
                    console.log("Error:");
                    console.log(error);
                    save_btn.prop('disabled', false);
                }
            });
    } else {
        alert ('Зверніть увагу!\nВсі поля ОБОВ\'ЯЗКОВІ для заповнення!');
        save_btn.prop('disabled', false);
    }
   });
});
