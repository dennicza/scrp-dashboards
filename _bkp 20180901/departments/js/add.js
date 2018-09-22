$(document).ready(function(){
    $('#save2db').click(function(){
        var query = $(this).data('query');
        var data = {};

        var fields = ['name', 'id', 'branch_id'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        save2db(data, query);
// console.log (data);
    });

    $('#cancel').on('click', function() {
        window.location.assign('/departments/?' + $(this).data('query'));
    });
});


function save2db(data, query) {
   data.save2db = 1;
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "html",
        data: data,

        success: function(data){
// console.log (data);
            if (data > 0) {
                alert ("Запис було збережено\n\nВдалої роботи!");
                window.location.assign('/departments/?' + query);
            } else {
                alert ("При збереженні виникла помилка\n\nСпробуйте повторити збереження пізніше");
            }
        },

        error: function(error){
            console.log("Error:");
            console.log(error);
        }
    });
}