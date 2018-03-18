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

    $('#upd2db').click(function(){
        var binding = $('#upd2db').data("binding");
        var data = {upd2db: binding};

        var fields = ['comp_id', 'dep_id', 'g_inner_id', 'g_inner_name', 'g_comp_id'];
        fields.forEach(function(item) {
            data[item] = $('#'+item).val();
        });

        var chbx = ['ident', 'is_active'];
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

        success: function(data){
            if (data > 0) {
                alert ("Зв'язування було онвлено\n\nВдалої роботи!");
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