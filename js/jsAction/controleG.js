$(document).ready(function(){
$("#forM").css('color','red');
$idPeriode="";
$locale="";
$joure="";
$obCase="";
$("td[id]").click(function(){

if($(this).html().length == 0 || ($(this).css('color') == $("#forM").css('color')))
{
 $joure=$(this).next().val();
$idPeriode = $(this).attr('id');
$locale = $(this).attr('class');
$obCase=$(this);
$('#myModal2').modal('show');}

});

$('#myModal2').on('hide.bs.modal', function (e) {
$("#err").text("");
});


$("#validerPeriode").click(function(){

  var id=$obCase.attr('id');
  var cl = "."+$obCase.attr('class');
    var d = new Date($("#datePute").val());
var jours = new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");

    if(!isNaN(Date.parse(d)))
     {
      $("#err").text("Le jour correspand est "+jours[d.getDay()]);
      if($joure==jours[d.getDay()])
      {
        $dt=d.getFullYear()+"-"+(d.getMonth()+1)+"-"+ d.getDate();
          $.ajax({
          url : "class/addResrvation.php",
          type : "POST",
          data : {JourTranche:$idPeriode,locale:$locale,date:$dt},
          dataType : "text",
          success : function(a,st)
          {
            if(a==1){

   if ($("."+$obCase.attr('class')+"[id='"+$obCase.attr('id')+"']").html().length == 0)
      {
        $("."+$obCase.attr('class')+"[id='"+$obCase.attr('id')+"']").append("<span class='text-center'>Les dates de réservations : </span><br>");
        $("."+$obCase.attr('class')+"[id='"+$obCase.attr('id')+"']").append("<span class='text-center'>"+d.getFullYear()+"-"+(d.getMonth()+1)+"-"+ d.getDate()+"</span><br>");
        $("."+$obCase.attr('class')+"[id='"+$obCase.attr('id')+"']").css('color','red');
      }
      else
      {
        $("."+$obCase.attr('class')+"[id='"+$obCase.attr('id')+"']").append("<span class='text-center'>"+d.getFullYear()+"-"+(d.getMonth()+1)+"-"+ d.getDate()+"</span><br>");
      }

              $("#myModal2").modal("hide");
            }else{alert("Vérifier la date ! ");}


          } });
    }
      else{alert("Vérifier la date !!");}
    }
     else {alert("Vérifier la date !!");}
});




});



 function format(obj){
var str=obj.value.replace(/-|\.|\\|\//g,'')
switch(true){
 
 case (str.length==4) :
 tel=str.replace(/^(\d{4})$/,"$1-")
  obj.value=tel
  break;
 case (str.length==6):
  tel=str.replace(/^(\d{4})(\d{2})$/,"$1-$2-")
  obj.value=tel
  break;
  case (str.length==8):
  tel=str.replace(/^(\d{4})(\d{2})(\d{2})$/,"$1-$2-$3")
  obj.value=tel
  break;
 case (str.length>8) :
  obj.value=str.substr(0,8).replace(/^(\d{4})(\d{2})(\d{2})$/,"$1-$2-$3")
  }
 
 }