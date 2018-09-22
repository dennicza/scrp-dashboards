$(document).ready(function(){
    $('#upd2db').click(function(){
        var monitoring = $('#upd2db').data("monitoring");
        var data = {upd2db: monitoring};

        var fields = ['comp_id', 'dep_id', 'start_0', 'frequency', 'week_day'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        data['wd'] = $('#week_day :selected').text();
        data['dist'] = 28 / data['frequency'];      //    dist = (4 / frequency * 7)

        var chbx = ['is_active'];
        chbx.forEach(function(item) {
            data[item] = $('#'+item).is(':checked') * 1;
        });

        upd2db(data);
    });
});


function upd2db(data) {
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "html",
        data: data,

        success: function(data) {
console.log (data);
            if (data > 0) {
                alert ("Моніторинг було оновлено\n\nВдалої роботи!");
                document.location.reload(true);
            } else {
                alert ("При оновленні виникла помилка\n\nСпробуйте повторити збереження пізніше");
            }
        },

        error: function(error){
            console.log("Error:");
            console.log(error);
        }
    });
}