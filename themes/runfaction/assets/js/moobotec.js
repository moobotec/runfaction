
(function ($) {
  'use strict'

  var $sidebar = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $sidebar.append($container)
  
  $container.append('<a class="nav-link" data-widget="fullscreen" href="#" role="button">Basculer en plein écran</a>\
  <hr class="mb-2"/>\
  <h6>Ip local : </h6> <div class="d-flex"><span class="mb-3">'+ip_local+'</span></div>\
  <h6>Ip public : </h6> <div class="d-flex"><span class="mb-3">'+ip_public+'</span></div>\
  <h6>Identifiant de session : </h6> <div class="d-flex"><span class="mb-3">'+session_id+'</span></div>\
  <h6>Date de connexion :</h6> <div class="d-flex"><span class="mb-3">'+timeConverter(deleted_time)+'</span></div>\
  <h6>Persistance connexion :</h6> <div class="d-flex"><span class="mb-3">'+((is_cookie == 1)? 'Oui':'Non')+'</span></div>\
  <h6>Environnement :</h6> <div class="d-flex"><span class="mb-3">'+environnementMoobotec+'</span></div>\
  <h6>Error Reporting :</h6> <div class="d-flex"><span class="mb-3">'+error_reporting+'</span></div>\
  <h6>Base BDD :</h6> <div class="d-flex"><span class="mb-3">'+baseMoobotec+'</span></div>\
  <h6>Version :</h6> <div class="d-flex"><span class="mb-3">'+versionMoobotec+'</span></div>\
  <h6>Chargée en :</h6> <div class="d-flex"><span id="execution-time" class="mb-3"> 0s </span></div>' )

  const allstars = document.querySelectorAll('.fa-star')
  allstars.forEach(star => {
    star.onclick = () => {
        let starlevel = star.getAttribute('data-num')
        allstars.forEach(el => { //loop through stars again to compare the clicked star to all other stars
           if(starlevel < el.getAttribute('data-num')) {
                el.classList.remove('fas')
                el.classList.add('far')
           }
           else {
              el.classList.remove('far')
              el.classList.add('fas')
           }
        });
    }
  });

  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

})(jQuery)

/*
 * La fonction jQuery.extend() est utilisée pour étendre la fonction de tri de la bibliothèque DataTables avec une nouvelle fonction de tri appelée "date-euro".
 * Cette fonction de tri permet de trier les colonnes contenant des dates au format "JJ/MM/AAAA HH:mm:ss" de manière ascendante ou descendante.
 */
jQuery.extend(jQuery.fn.dataTableExt.oSort, {
  "date-euro-pre": function (a) {
      var x;
      if (a.trim() !== '') {
          var frDatea = a.trim().split(' ');
          var frTimea = (undefined != frDatea[1]) ? frDatea[1].split(':') : [0o00, 0o00, 0o00];
          var frDatea2 = frDatea[0].split('/');
          x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + ((undefined != frTimea[2]) ? frTimea[2] : 0)) * 1;
      }
      else {
          x = Infinity;
      }
      return x;
  },

  "date-euro-asc": function (a, b) {
      return a - b;
  },

  "date-euro-desc": function (a, b) {
      return b - a;
  }
});

function readUrl(input,idInput) {
  var url = input.value;
  var ext = url.substr(url.lastIndexOf('.') + 1);
  if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
  {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#imagePreview').css('background-image', 'url('+ e.target.result +')');
          $('#imagePreview').hide();
          $('#imagePreview').fadeIn(650);
          document.getElementById(idInput).value = remove_accents(input.files[0].name);
      }
      reader.readAsDataURL(input.files[0]);
  }else{
       //$(\'#imagePreview\').css(\'background-image\', \'url(\''.BASEPATH.'assets/images/180.png\')\');
       document.getElementById(idInput).value = "";
  }
}

function readSendImage(input,idInput) 
{
  if (input.files && input.files[0]) 
  {
    readUrl(input,idInput);
  }
}

$("#imageVignette").change(function(){
  readSendImage(this,'input_imageVignette');
});

function show_user_profil()
{
    window.location.href = window.location.origin + '/profil.php';
}

function deconnexion_user()
{
    window.location.href = window.location.origin + '/logout.php';
}

