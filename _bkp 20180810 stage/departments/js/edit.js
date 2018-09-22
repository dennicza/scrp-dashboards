$(document).ready(function(){
    $('#upd2db').click(function(){
        var department = $('#upd2db').data("department");
        var data = {upd2db: department};

        var fields = ['name', 'id', 'branch_id'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        upd2db(data);
// console.log(data);
    });

    $('#cancel').on('click', function() {
        window.location.assign('/departments/');
    });
});


function upd2db(data) {
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "html",
        data: data,

        success: function(data){
// console.log(data);
            if (data > 0) {
                alert ("Запис було оновлено\n\nВдалої роботи!");
                window.location.assign('/departments/');
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