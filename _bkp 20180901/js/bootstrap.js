$(document).ready(function(){
    var table = $($("body")[0]).data("table");
    
    $.ajax({
         url: "ajax.php",
         type: "POST",
         dataType: "json",
         data: { bootstrap: table},
 
         success: function(data){
             flt['all'] = data;
             fltrd = data;
         },
 
         error: function(error){
             console.log("Error:");
             console.log(error);
         }
     });
 
    $('#download').click(function(){
        var obj = fltrd;
        if (obj == '') return;
        JSONToCSVConvertor(obj, table, true);
    });

    $('#go2add').click(function(){
        window.location.assign (window.location.href.replace('/?', '/add.php?'));
    });

    $('#go2edit').click(function(){
        if ($('tr.active').attr('id') !== undefined) {
            window.location.assign (window.location.href.replace('/?', '/edit.php?') + '&' + $('tr.active').data("edit"));
        } else {
            alert ("Спочатку оберіть рядок, який Ви бажаєте відредагувати");
        }
    });

    $('#delete').click(function(){
        if ($('tr.active').attr('id') !== undefined) {
            if (confirm('Ви справді бажаєте видалити цей рядок?')) {
                $.ajax({
                    url: "ajax.php",
                    type: "POST",
                    dataType: "json",
                    data: { delete: $('tr.active').attr('id').substr(1),
                            table: table},
            
                    success: function(data) {
                        if (data > 0) {
                            // window.location.assign (window.location.protocol + '//' + window.location.hostname + '/' + table);
                            window.location.reload(true);
                        } else {
                            alert ("Виникла помилка авторизації\n\nЗв'яжіться з адміністратором системи");
                        }
                    },
            
                    error: function(error) {
                        console.log("Error:");
                        console.log(error);
                    }
                });
            }
        } else {
            alert ("Спочатку оберіть рядок, який Ви бажаєте видалити");
        }
    });
 
 });
