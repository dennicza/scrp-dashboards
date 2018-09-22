$(document).ready(function(){
    $('#comp_id').on('change', function() {
        var comp = this.value;
        $.ajax({
            url: "ajax.php",
            type: "POST",
            dataType: "html",
            data: { comp2goods: comp },

            success: function(data){
                $("#comp_goods").html(data);
            },

            error: function(error){
                console.log("Error:");
                console.log(error);
            }
        });
    });

    $('#save2db').click(function(){
        var data = {};

        var fields = ['comp_id', 'dep_id', 'g_inner_id', 'g_inner_name', 'g_comp_id'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        var chbx = ['ident', 'is_active'];
        chbx.forEach(function(item) {
            data[item] = $('#'+item).is(':checked') * 1;
        });

        save2db(data);
    });

    $('#cancel').on('click', function() {
        window.location.assign('/bindings/');
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
                window.location.assign('/bindings/');
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