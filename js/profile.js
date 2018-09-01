$(document).ready(function () {
 var url="profile.php";
      $(".profile").click(function(){
      $.post(url,{action:"chercher"},function(data){
            $("#prf").empty().append(data);
      });
   });  

});