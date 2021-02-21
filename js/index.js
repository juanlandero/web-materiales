$(document).ready(function() {



$('.equal .label')
    .transition({
        animation : 'jiggle',
        duration  : 800,
        interval  : 2000,
  })
;

  $('#modal_maps').modal('attach events', '#btn_maps', 'show');

  $('.inline.icon').popup({
      inline: true
  });
  

  $('.masthead').visibility({
      once: false,onBottomPassed: function() {
          $('.fixed.menu').transition('fade in');
      },
      onBottomPassedReverse: function() {
          $('.fixed.menu').transition('fade out');
      }
  });
  // create sidebar and attach to menu open
  $('.ui.sidebar').sidebar('attach events', '.toc.item');
  

  $('.ui.menu .ui.dropdown').dropdown({
      on: 'hover'
  });
  $('.ui.menu a.item').on('click', function() {
      $(this).addClass('active').siblings().removeClass('active');
  });
});

//Envio del correo electrónico
$('form#enviar_mail').submit(function(e){
	e.preventDefault();
    var data = $(this).serializeArray();
    $.ajax({
        url: 'logic/email.php',
        type: 'POST',
        dataType: 'json',
        data: data
    })
    .done(function(dato){
        console.log($('.ui.form').form('is valid'));
        if($('.ui.form').form('is valid')){
            $('#modal_email').modal('show');	
            $('#nombre').val("");
            $('#mail').val("");
            $('#mensaje').val("");
        }
    })
    .fail(function(){
      alert("No se puede enviar el correo, favor de comunicarse por otro medio.");
    });
});


$('.ui.form').form({
    fields: {
      nombre: {
        identifier : 'nombre',
        rules: [{
            type   : 'empty',
            prompt : 'Ingrese su nombre completo'
          }]
      },
      mensaje: {
        identifier : 'mensaje',
        rules: [{
            type   : 'empty',
            prompt : 'Ingrese el mensaje'
          }]
      },
      email: {
        identifier : 'email',
        rules: [{
            type   : 'email',
            prompt : 'Ingrese un e-mail válido'
        }]
      }
    },
    inline : true,
    on     : 'blur',
  });