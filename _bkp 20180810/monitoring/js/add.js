$(document).ready(function(){
    $('#save2db').click(function(){
        var query = $(this).data('query');
        var data = {};

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

        //  start_at        (SELECT DATE_ADD(start_0, INTERVAL (SELECT (MOD(7 + week_day - WEEKDAY(start_0), 7))) DAY))

        save2db(data, query);
    });

    $('#cancel').on('click', function() {
        window.location.assign('/monitoring/?' + $(this).data('query'));
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
            if (data > 0) {
                alert ("Запис було збережено\n\nВдалої роботи!");
                window.location.assign('/monitoring/?' + query);
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