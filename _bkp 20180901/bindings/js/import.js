$(document).ready(function(){
    $('#import').click(function(){
        $.ajax({
            url: "ajax_imp.php",
            type: "POST",
            dataType: "html",
            data: {import : 1},
    
            success: function(data){
                if (data) {
                    var res = data.split('/');
                    $('#res').html('<br>Було додано/оновлено <b>' + res[0] + '</b> записів з <b>' + res[1] + '</b> рядків таблиці');
                } else {
                    alert ("При збереженні виникла помилка\n\nСпробуйте повторити збереження пізніше");
                }
            },
    
            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });
    });

    $('#upload').on('click', function() {
        var file_data = $('#exampleInputFile').prop('files')[0];   
        var form_data = new FormData();
        form_data.append('file', file_data);
        // console.log (form_data);
        $.ajax({
            url: 'upload.php', // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(php_script_response){
                // console.log (php_script_response);
                if (php_script_response == 1) {
                    alert ('Файл для імпорту було завантажено на сервер\n\nМожна перйти до процедури\nімпортування данних з файлу');
                } else {
                    alert (php_script_response);
                }
            }
        });
    });

    $('.custom-file-input').on('change', function() { 
        let fileName = $(this).val().split('\\').pop(); 
        $(this).next('.custom-file-control').addClass("selected").html(fileName); 
    });
});
