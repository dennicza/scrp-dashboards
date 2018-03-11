var flt = {}, fltrd = [];

var intersection = function(){
    return arguments[0].reduce(function(previous, current){
        return previous.filter(function(element){
            if (current) return JSON.stringify(current).indexOf(JSON.stringify(element)) > -1;
        });
    });
};

function applyFltr () {
    fltrd = intersection(Object.keys(flt).map(function (key) {
        return flt[key];
    }));
    renderTable(fltrd);
}

function renderTable(fltrd) {
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "html",
        data: { render: fltrd },

        success: function(data){
            $("#render").html(data);
        },

        error: function(error){
            console.log("Error:");
            console.log(error);
        }
    });
}

$(document).ready(function(){
    
    $('button.clear').click(function(){
        var el = $(this).data('clear');
        $('#' + el).val('');
        
        flt[el] = flt.all;
        applyFltr ();
    });

    $('input.filter').keyup(function(){
        var el = $(this);
        var id = el.prop('id');
        var s2 = el.val().toLowerCase();
        var res = flt['all'].filter(function(item){
            return item[id].toLowerCase().includes(s2);
        });
        $('#filter_' + id).html(JSON.stringify(res));
        
        flt[el.prop('id')] = res;
        applyFltr ();
    });
 
 });
