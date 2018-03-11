$(document).ready(function(){
    var table = $($("body")[0]).data("table");
    
    $.ajax({
         url: "ajax.php",
         type: "POST",
         dataType: "json",
         data: { bootstrap: table},
 
         success: function(data){
             flt['all'] = data;
             fltrd = data;
         },
 
         error: function(error){
             console.log("Error:");
             console.log(error);
         }
     });
 
     $('#download').click(function(){
         var obj = fltrd;
         if (obj == '') return;
         JSONToCSVConvertor(obj, table, true);
     });
 
 });