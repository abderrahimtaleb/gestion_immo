$(document).ready(function(){
$("#forM").css('color','red');
$idPeriode="";
$locale="";

            var Code='<script type="text/javascript">'+
            '$(".delete").click(function(e){e.preventDefault();'+
            '$id=$(this).attr("id");'+
            '$.ajax({'+
          'url : "class/DeletResrvation.php",'+
          'type : "POST",'+
          'data : {idOccupation:$id},'+
          'dataType : "text",'+
          'success : function(a,st)'+
          '{if(a == 1){window.location.reload();}}});'+
              '});'+
              '</script>';

$("td[id]").click(function(){

if($(this).css('color') == $("#forM").css('color'))
{
$idPeriode = $(this).attr('id');
$locale = $(this).attr('class');
          $.ajax({
          url : "class/getResrvation.php",
          type : "POST",
          data : {JourTranche:$idPeriode,locale:$locale},
          dataType : "text",
          success : function(a,st)
          {
            if(a != "")
            {
              $("#tbody").html(a);
              $('#myModal2').modal('show');
              $("#forM").html(Code);
            }
          }
          });

}

});


$("#validerPeriode").click(function(){

          $.ajax({
          url : "class/addResrvation.php",
          type : "POST",
          data : {JourTranche:$idPeriode,locale:$locale},
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

    
});




});

