$(document).ready(function(){

var $idFiliere='';
var $idLocale='';
var $idEns='';
var $idMatiere='';
var $jourTranche='';

var $idLocaleAgarder='';
            var Code='<script type="text/javascript">$(function(){ $(".NonSup").click(function(){id = $(this).val();$("#idOccpation").val(id);'+
              '$("."+id).fadeOut(1000);$("#forModifText").text("Modifier cette période !");$("#validerPeriode").addClass("btn-success");'+
              ' $("#forModifText").addClass("text-success");'+
              '$idLocaleAgarder=$("#"+id).find("span[class=\'locale\']").text();'+
              ' $("#myModal2").modal("show");});'+
'$(".RienO").click(function(){$("#RienCliquer").val("1"); $("#myModal2").trigger("hide");});'+
'$(".okSup").click(function(){'+
  '$("#idOksup").val($(this).val());$("#child").val($(this).parent().children().val());$("#myModalSupp").modal("show")'+
  ' });     });</script>';
$("#SelectFiliere").change(function(e)
{
  var filiere=$('#SelectFiliere option:selected').val();
  if(filiere != '')
  {
    $idFiliere=filiere; $("#NomFiliere").text('La filière '+$('#SelectFiliere option:selected').text());
   
        $.ajax({
          url : 'class/afficheEmploie.php',
          type : 'POST',
          data : {id_filiere:$idFiliere},
          dataType : 'json',
          success : function(a,st)
          { 
              
            if(a.length > 0) {
              var i=0;
              $('td[id]').each( function(){$(this).html(a[i]); ++i;} );
              $("#mettez").html(Code);
            }
            
          },
            error : function(resultat, statut, erreur){
                alert('Veuillez ressayer ulterieurement '+resultat+' '+statut+' '+erreur);
          }
        });
      }else 
      {$idFiliere='';$("#NomFiliere").text('');$('td[id]').each( function(){$(this).html("");} );}

});

$("#deleteAllEmploi").click(function(){ 
          $.ajax({
          url : "class/supprimerTT.php",
          data : false,
          dataType : "text",
          success : function(a,st)
          {
            if(a==1){
              window.location.reload();
            }
          } });
});
$("#supprimerPeriode").click(function(){

          $.ajax({
          url : "class/supprimerPeriode.php",
          type : "POST",
          data : {idP:$("#idOksup").val()},
          dataType : "text",
          success : function(a,st)
          {
            if(a==1){
              $("#"+$("#child").val()).html("");
              $("#myModalSupp").modal("hide");
            }else{alert("réessayez à nouveau ! ");}
          } });
});

$("td[id]").click(function(){
  if($idFiliere!=''){
  $jourTranche=$(this).attr('id');
  $idO = $(this).children().attr('id');
if($(this).html().length == 0)
{
        $.ajax({
          url : 'controle/getDataLocale.php',
          type : 'post',
          data : {jourTranche:$jourTranche},
          dataType : 'json',
          success : function(str,st)
          { 
            $("#selectForLocal").html(str[0]);
            $("#selectForEns").html(str[1]);
            $("#selectForM").html(str[2]);
          },
            error : function(resultat, statut, erreur){
                alert('Veuillez ressayer ulterieurement');
          }
        });
$("#err").addClass('disp');
$('#myModal2').modal('show');}
else
{
  $idLocaleAgarder = $(this).find("span[class='locale']").text();
  valRien = $("#RienCliquer").val();
  if(valRien == 0)
  $("."+$idO).fadeIn();
  else{$("."+$idO).fadeOut();$("#RienCliquer").val("0");}
}
}

});

$('#myModal2').on('show.bs.modal', function (e) {

if($("#validerPeriode").hasClass("btn-success"))
{
          $.ajax({
          url : 'controle/getDataLocale.php',
          type : 'POST',
          data : {jourTranche:$jourTranche},
          dataType : 'json',
          success : function(str,st)
          { 
            $("#selectForLocal").html(str[0]);
            $("#selectForEns").html(str[1]);
            $("#selectForM").html(str[2]);
            $('#selectForLocal').append('<option value="'+$idLocaleAgarder+'">'+$idLocaleAgarder+'</option>');
          },
            error : function(resultat, statut, erreur){
                alert('Veuillez ressayer ulterieurement');
          }
        });
}


});


$('#myModal2').on('hide.bs.modal', function (e) {
$("."+$('#idOccpation').val()+"").fadeOut();$("#err").addClass('disp');
$("#validerPeriode").removeClass("btn-success"); $("#forModifText").removeClass("text-success");
$("#forModifText").text("Marquez cette période !");
});





$("#selectForLocal").change(function(e)
{
  $idLocale=$('#selectForLocal option:selected').val();
});
$("#selectForEns").change(function(e)
{
  $idEns=$('#selectForEns option:selected').val();
  
});
$("#selectForM").change(function(e)
{
  $idMatiere=$('#selectForM option:selected').val();
});

$("#validerPeriode").click(function(){

var $url='';
  if(! $("#validerPeriode").hasClass("btn-success"))
{$url='controle/insertData.php';}
else{$url='controle/updateData.php';}

  $idFiliere = $('#SelectFiliere option:selected').val();
  $idLocale=$('#selectForLocal option:selected').val();

    $idEns=$('#selectForEns option:selected').val();
      $idMatiere=$('#selectForM option:selected').val();
                         $.ajax({
          url : $url,
          type : 'POST',
          data : {idLocale:$idLocale,idEns:$idEns,idMatiere:$idMatiere,idFiliere:$idFiliere,jourTranche:$jourTranche,group:$("#Groupe").val(),idOccpation:$("#idOccpation").val()},
          dataType : 'text',
          success : function(str,st)
          { if(str != 0)
           {
            var pr = '<span class="text-primary ici" id="'+str+'"><strong class="text-danger"> Locale :</strong> <span class="locale">'+$idLocale+'</span></span><br>'+
  '<span class="text-primary"><strong class="text-danger"> Enseignant/Departement :</strong> '+$('#selectForEns option:selected').text()+'</span><br>'+
   '<span class="text-primary"><strong class="text-danger">               Matière :</strong> '+$('#selectForM option:selected').text()+'</span><br>'+
   '<span class="text-primary"><strong class="text-danger">                Groupe :</strong> '+$("#Groupe").val()+'</span>'+
   '<center>'+
'<span class="text-danger statut disp '+str+'">'+
'<input type="hidden" value="'+$jourTranche+'">'+
 '<button class="btn btn-sm btn-warning okSup" value="'+str+'">Supprimer</button><button class="btn btn-sm btn-success NonSup" value="'+str+'">Modifier</button>'+
 '<button class="btn btn-sm btn-info RienO" value="'+str+'">Rien</button></span>'+
 '</center>';  
            $("#"+$jourTranche).html(pr);$("#err").addClass('disp');
            $('#myModal2').modal('hide');
              $("#mettez").html(Code);
                         
          }else {$("#err").removeClass('disp');}
          



          },
            error : function(resultat, statut, erreur){
                alert('Veuillez ressayer ulterieurement');
          }
        });

});

  });
