var flt = {}, fltrd = [], page_, per_page = 0;

var intersection = function(){
    return arguments[0].reduce(function(previous, current){
        return previous.filter(function(element){
            if (current) return JSON.stringify(current).indexOf(JSON.stringify(element)) > -1;
        });
    });
};

/*
function applyFltr () {
    fltrd = intersection(Object.keys(flt).map(function (key) {
        return flt[key];
    }));
    renderTable(fltrd);
}
*/

function applyFltr () {
    var fff = intersection(Object.keys(flt).map(function (key) {
        return flt[key];
    }));
    
    if (per_page) {
        page_ = window.location.search.substr(3);
        if (!page_.length) page_ = 1;
        var p1 = page_ * per_page;
        var p0 = p1 - per_page - 1;
        fltrd = fff.filter(function(item, i){return (i > p0) && (i < p1)});
    } else {
        fltrd = fff;
    }
   
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
            tableRows ();
        },

        error: function(error){
            console.log("Error:");
            console.log(error);
        }
    });
}

function tableRows() {
    $('tr').on('click', function() {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active'); 
        } else {
            $(this).addClass('active').siblings().removeClass('active');
        }
    });

    $('tr').css('cursor', 'pointer');
}

function populateData() {
    var arr = window.location.search.split('?')[1];
    arr.split('&').forEach(function(item) {
        var ar = item.split('=');
        $('#' + ar[0]).val(decodeURIComponent(ar[1]));
    });
}

$(document).ready(function() {
    populateData();

    $('.datepicker').datepicker({
        language: 'uk',
        format: 'yyyy-mm-dd',
        // endDate: '0d',
        container: '.dp',
        autoclose: true
    });
    
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


    $('button.apply').click(function() {
        var url = window.location.search.split('?');
        var id = $(this).data('apply');
        var val = $('#' + id).val().toLowerCase();
        if (!val.length) return false;
        if (url[1].indexOf('&' + id + '=') > -1) {
            var arr = url[1].split('&');
            var query = arr.reduce(function(res, item) {
                if (item.indexOf(id + '=') == -1) return res + '&' + item;
                return res + '&' + id + '=' + val;
            });
            window.location.assign(url[0] + '?' + query);
        } else {
            window.location.assign(window.location.href + '&' + id + '=' + val); 
        }
    });

    $('button.clr').click(function(){
        var url = window.location.search.split('?');
        var id = $(this).data('clr');
        var arr = url[1].split('&');
        var query = arr.reduce(function(res, item) {
            if (item.indexOf(id + '=') == -1) return res + '&' + item;
            return res;
        });
        window.location.assign(url[0] + '?' + query);
    });

 });
