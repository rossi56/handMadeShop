/*********************************************************Validation des formulaires côté client**********************************/

$(document).ready(function(){

    var resultat = true;
  
    $('.form').submit(function(){
      if($('.form-control').val() == ''){
        $('.form-control').parent().addClass('has-error');
          $('.help').text('Ce champs est obligatoire !').css('color', 'red');
          $('.helpComment').text('Aucun commentaire à envoyer !').css('color', 'red');
          $('.helpImage').text('Aucune image n\'a été sélectionnée !').css('color', 'red');
          $('.helpCategory').text('Aucune catégorie n\'a été sélectionnée !').css('color', 'red');
          $('.helpSubCategory').text('Aucune sous-catégorie n\'a été sélectionnée !').css('color', 'red');
          $('.helpMail').text('Veuillez entrer une adresse mail au bon format !').css('color', 'red');




          resultat = false;
      }
      else{
        $('.helpInscription').addClass('has-success');
        $('.helpInscription').text('Inscription validée !').css('color', 'green');
      }
      return resultat;
    });


      $('.form-control').keyup(function(){
        $('.form-control').parent().removeClass('has-error');
        $('.help').text('');
        $('.helpComment').text('');
        $('.helpImage').text('');
        $('.helpCategory').text('');
        $('.helpSubCategory').text('');
        $('.helpMail').text('');

      });
     
  });