$(document).ready(function(){
    $('#save2db').click(function(){
        var data = {};

        var fields = ['aggr_id', 'comp_id', 'aggr_comp_name'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        save2db(data);
    });

    $('#cancel').on('click', function() {
        window.location.assign('/aggregators/');
    });
});


function save2db(data) {
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
                window.location.assign('/aggregators/');
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