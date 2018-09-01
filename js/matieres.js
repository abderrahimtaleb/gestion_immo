$(document).ready(function () {
 var url="matieres.php";
      $(".mod").click(function(){
      var id=$(this).attr("id");
      $.post(url,{action:"chercher",id:id},function(data){
            $("#mydiv").empty().append(data);
      });
   });  

});

        
