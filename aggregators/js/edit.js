$(document).ready(function(){
    $('#upd2db').click(function(){
        var id = $('#upd2db').data("lnk");
        var data = {upd2db: id};

        var fields = ['aggr_id', 'comp_id', 'aggr_comp_name'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        upd2db(data);
    });

    $('#cancel').on('click', function() {
        window.location.assign('/aggregators/');
    });
});


function upd2db(data) {
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "html",
        data: data,

        success: function(data){
            if (data > 0) {
                alert ("Запис було оновлено\n\nВдалої роботи!");
                window.location.assign('/aggregators/');
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