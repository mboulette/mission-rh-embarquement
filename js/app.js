/* signin */
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}

String.prototype.passwordMeter = function() {
	var $point = 0;
	if (this.length > 5) $point++;
	if (this.length > 7) $point++;
	if (this.length > 9) $point++;
	if (this.length > 14) $point++;

	if (this.match(/\d+/g)) $point++;
	if (this.match(/[a-z]+/g)) $point++;
	if (this.match(/[A-Z]+/g)) $point++;
	if (this.match(/\W+/g)) $point+=2;

	return $point;
}

$(function() {

	if ($('.marquee').length > 0) {
		setInterval(function(){
			$( ".marquee-content div:first" ).slideUp( "slow", function() {
				$('.marquee-content div:first').appendTo('.marquee-content:first').show();
			});

		}, 5000);
	}

	$('[data-toggle="popover"]').popover();

	/*******************************************************************************/
	/***  Reset Password
	/*******************************************************************************/

	$('#reset_show_password').on('click', function(){

		if ( $(this).is(':checked') ){
		    $('#reset_password').prop('type', 'text');
		    $('#reset_verification').prop('type', 'text');
		} else {
		    $('#reset_password').prop('type', 'password');
		    $('#reset_verification').prop('type', 'password');
		}

	});

	$('#reset_form').on('submit', function( event ){
		event.preventDefault();
		event.stopPropagation();

		$('.has-error').removeClass('has-error');
		$('.alert').addClass('hidden');

		if ($('#reset_verification').val() != $('#reset_password').val()) {
			$('#reset_password').parent().parent().addClass('has-error');
			$('#reset_verification').parent().addClass('has-error');
			$('.msg-reset-error').removeClass('hidden');
		} else {

			if ($('#reset_password').val().passwordMeter() < 3 ) {
				
				$('.msg-password-meter').removeClass('hidden');
				$('#reset_password').parent().parent().addClass('has-error');
				$('#reset_verification').parent().addClass('has-error');
				return;
			}

			$.post("/inscriptions/auth", $("#reset_form").serialize()+'&action=reset', function(data) {

			  if (data.trim() == 'false') {
			  	$('.msg-reset-error').removeClass('hidden');
			  } else {
			  	window.location.replace('/inscriptions');
			  }

			});
		}


	});



	/*******************************************************************************/
	/***  SIGN-IN
	/*******************************************************************************/

	$('#signin_show_password').on('click', function(){

		if ( $(this).is(':checked') ){
		    $('#signin_password').prop('type', 'text');
		} else {
		    $('#signin_password').prop('type', 'password');
		}

	});



	$('#signin_form').on('submit', function( event ){
		event.preventDefault();
		event.stopPropagation();

		$('.has-error').removeClass('has-error');
		$('.alert').addClass('hidden');

		if ($('#signin_email').val() == '' || $('#signin_password').val() == '') {
			$('#signin_email, ').parent().addClass('has-error');
			$('#signin_password').parent().parent().addClass('has-error');
		} else {

			$.post("/inscriptions/auth", $("#signin_form").serialize()+'&action=signin', function(data) {

			    switch(data.trim()) {
			    	case 'false' :
			    		$('.msg-signin-error').removeClass('hidden');
			    		break;

			    	case 'lock' :
						$('.msg-signin-lock').removeClass('hidden');
			    		break;

			    	default:
			    		window.location.replace('/inscriptions/home');
			    }
			});
		}


	});

	$('#sign-up').on('click', function(){
		
		$('.has-error').removeClass('has-error');
		$('.alert').addClass('hidden');

		if ($('#signin_email').val() == ''
			|| !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/.test($('#signin_email').val()))
			|| $('#signin_password').val() == ''
		) {
			
			if ($('#signin_password').val() == '') $('#signin_password').parent().parent().addClass('has-error');
			$('#signin_email').parent().addClass('has-error');
			$('#modal-signup').modal('show');
		} else {

			if ($('#signin_password').val().passwordMeter() < 3 ) {
				
				$('.msg-password-meter').removeClass('hidden');
				$('#signin_password').parent().parent().addClass('has-error');
				return;
			}


			$.post("/inscriptions/auth", $("#signin_form").serialize()+'&action=signup', function(data) {

			  if (data.trim() == 'false') {
			  	$('.msg-signup-error').removeClass('hidden');
			  } else {
			  	window.location.replace('/inscriptions/home');
			  }

			});

		}

	});

	$('#forgot-password').on('click', function(){

		$('.has-error').removeClass('has-error');
		$('.alert').addClass('hidden');

		if ($('#signin_email').val() == '') {
			$('#signin_email').parent().addClass('has-error');
			$('#modal-forget-password').modal('show');			
		} else {


			$.post("/inscriptions/auth", $("#signin_form").serialize()+'&action=password', function(data) {

			  if (data.trim() == 'false') {
			  	$('.msg-password-error').removeClass('hidden');
			  } else {
			  	$('.msg-password-success').removeClass('hidden');
			  }

			  $('.reset-modal-content').html(data);
			  $('#modal-reset').modal('show');

			});

		}


	});


	/*******************************************************************************/
	/***  characters
	/*******************************************************************************/

	$('.card:not(.disabled)').on('mouseover mouseout', function(){
		$(this).find('.ribbon').toggleClass('ribbon-active');
	});

	$('.card:not(.disabled)').on('click', function(){
		$(this).find('form').submit();
	});

	
	$('.credit-card-panel .card.card-credit:not(.disabled)').on('click', function(event){
		event.preventDefault();
		event.stopPropagation();

		$("#info-update").modal('show');
	});
	

    $("#characters_attachments").fileinput({
        language: 'fr',
        uploadUrl: '/inscriptions/upload', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['pdf', 'doc', 'docx', 'odf', 'jpg', 'jpeg', 'png'],
        overwriteInitial: false,
        maxFileSize: 1000,
        browseOnZoneClick : true,
        minFileCount: 1,
        showUploadedThumbs: false,
        slugCallback: function (filename) {
            return filename.replace('[', '_').replace(']', '_');
        },
        uploadExtraData: function() {
            return {
                subdir : 'characters',
                id: $("#id_character").val(),
            };
        }

    });

    $('#characters_attachments').on('fileuploaded', function(event, data, previewId, index) {
		$('#files_lst').html(data.response.attachments_lst);
    });

    $('#characters_attachments').on('filebatchuploadcomplete', function(event, files, extra) {
    	$('#characters_attachments').fileinput('clear');
    });


    $('#form_character').on('submit', function(event){

    	
    	if ($('#step').val() == '1') {

    		$('.alert-required').hide();
    		$ok = true;

    		if (!$("input[name='id_corporation']:checked").val()) $ok = false;
    		if (!$("input[name='id_race']:checked").val()) $ok = false;
    		if (!$("input[name='id_profession']:checked").val()) $ok = false;

			if (!$ok) {
		    	event.preventDefault();
		    	event.stopPropagation();
				$('.alert-required').show();
			}

    	}

    	if ($('#step').val() == '2') {

    		$('.alert-required').hide();
    		$ok = true;

    		if (!$("input[name='id_skill']:checked").val()) $ok = false;
    		   		
			if ($("input[name='id_skill']:checked").first().val() == '21') {
				if ($("input.checkbox_card:checked").length != 3) $ok = false;
			} else {
				if ($("input.checkbox_card:checked").length != 2) $ok = false;
			}


			if (!$ok) {
		    	event.preventDefault();
		    	event.stopPropagation();
				$('.alert-required').show();
			}

    	}

    	if ($('#step').val() == '3') {

	    	if ( $('#characters_attachments').fileinput('getFilesCount') != 0 ) {
		    	event.preventDefault();
		    	event.stopPropagation();
	    	
		    	$('#modal-attachements').modal('show');
	    	}
	    }

    });

	$('.delete_character').on('click', function(event){

		event.preventDefault();
		event.stopPropagation();

		var $card = $(this).closest('.card-conteiner'); 
		var $id_character = $(this).data('id');


		$('#confirm').modal({ backdrop: 'static', keyboard: false })
			.one('click', '#delete', function() {
				
			$.post('/inscriptions/characters/erase', {'id_character' : $id_character}, function(data) {
				$card.remove();
			});

		});
	
	});



	/*******************************************************************************/
	/***  Cards
	/*******************************************************************************/

	$('.delete_card').on('click', function(event) {

		event.preventDefault();
		event.stopPropagation();

		var $card = $(this).closest('.card-conteiner'); 
		var $id_card = $(this).data('id');


		$('#confirm').modal({ backdrop: 'static', keyboard: false })
			.one('click', '#delete', function() {
				
			$.post('/inscriptions/cards/erase', {'id_card' : $id_card}, function(data) {
				$card.remove();
			});

		});
	
	});

	$('.alert-hide').on('click', function(event) {
		$(this).parent().addClass('hidden');
	});

	$('.radio_card').on('click', function(event) {
		$('.card.card-'+$(this).data('group')).removeClass('active');
	 	$(this).parents('.card').addClass('active');
	});

	$('.checkbox_card').on('click', function(event) {
	 	$(this).parents('.card').toggleClass('active');
	});


	/*******************************************************************************/
	/***  Profil
	/*******************************************************************************/

    $("#profil_attachments").fileinput({
        language: 'fr',
        uploadUrl: '/inscriptions/upload', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['pdf', 'doc', 'docx', 'odf', 'jpg', 'jpeg', 'png'],
        overwriteInitial: false,
        maxFileSize: 1000,
        browseOnZoneClick : true,
        minFileCount: 1,
        showUploadedThumbs: false,
        slugCallback: function (filename) {
            return filename.replace('[', '_').replace(']', '_');
        },
        uploadExtraData: function() {
            return {
                subdir : 'players',
                id: $("#id_player").val(),
            };
        }

    });

    $('#profil_attachments').on('fileuploaded', function(event, data, previewId, index) {
		$('#files_lst').html(data.response.attachments_lst);
    });

    $('#profil_attachments').on('filebatchuploadcomplete', function(event, files, extra) {
    	$('#profil_attachments').fileinput('clear');
    });


    $('#form_profile').on('submit', function(event){

		$('.alert-decharge').addClass('hidden');

    	if ( $('#profil_attachments').fileinput('getFilesCount') != 0 ) {
	    	event.preventDefault();
	    	event.stopPropagation();
    	  	$('#modal-attachements').modal('show');
    	}

		$('#gender').val('M');
		if ($('#gender-x').is(':checked')) $('#gender').val('F');

		if (!$('#decharge').is(':checked')) {
	    	event.preventDefault();
	    	event.stopPropagation();
			$('.alert-decharge').removeClass('hidden');
		}

    });

    $(document).on('click', '#decharge', function(event) {
    	$(this).parents('label').find('i').toggleClass('hidden');
    });



	/*******************************************************************************/
	/***  Commun
	/*******************************************************************************/

	$(".session_message").delay(8000).slideUp(200, function() {
	    //$(this).alert('close');
	});

	$('input,textarea,select').filter('[required]:visible').each(function(){
		try {
			$('[for='+$(this).attr('name')+']').not('.input-group-addon').addClass('required');
		} catch (e) {}
	})


	/*******************************************************************************/
	/***  Home
	/*******************************************************************************/
	$(".home-step").on('click', function(event){
		$(this).submit();
	});

	/*******************************************************************************/
	/***  Event
	/*******************************************************************************/

	$('.card a').not('[data-toggle="modal"]').on('click', function(event){
		event.stopPropagation();
	});

	$('#form_register').on('submit', function(){
		event.stopPropagation();

		if ($('input[name="id_character"]:checked').length == 0) {
			event.preventDefault();
			$('#register-valid').modal();

			if (!$('#collapseOne').hasClass('in')) {
				$('h3.collapsed').first().click();				
			}

			return false;
		}

		if ($('input[name="id_card"]:checked').length == 0) {
			event.preventDefault();
			$('#register-valid').modal();

			if (!$('#collapseTwo').hasClass('in')) {
				$('h3.collapsed').last().click();
			}

			return false;
		}

		if ( parseInt($('#total-ressource').html()) > parseInt($('.max-credits').first().html()) || parseInt($('#total-ressource').html()) == 0 ) {
			event.preventDefault();
			$('#ressource-valid').modal();
			$('h3.collapsed.collapseCredit').last().click();

			return false;
		} 

		if (!$('#confirm').hasClass('in')) {

			event.preventDefault();

			$('#confirm').modal({ backdrop: 'static', keyboard: false })
				.one('click', '#payment', function() {
				$('#form_register').submit();

			});
			
			return false;

		}

	});

	if ($('#form_register').length > 0) {

		$('input[name=id_character].radio_card').on('click', function(){
			var profession = $(this).data('profession');
			var rank = $(this).data('rank');
			var credits = $(this).data('credits');

			$('.ressource_price').addClass('hidden');
			$('.ressource_' + profession).removeClass('hidden');
			$('#alert-no-char').addClass('hidden');
			$('.ressource_input, .ressource_plus').prop('disabled', false);

			$('.ressource_' + profession).each(function(){
				var ressource = $(this).data('id');
				var price = $(this).data('value');

				$('#qty_ressource_'+ressource).data('price', price);
			});

			if (parseInt(rank) < 3) {
				$('#ressources-level-3').addClass('hidden');
				$('#ressources-level-3').find('.ressource_input').val('0');
			} else {
				$('#ressources-level-3').removeClass('hidden');
			}

			if (parseInt(rank) < 2) {
				$('#ressources-level-2').addClass('hidden');
				$('#ressources-level-2').find('.ressource_input').val('0');
			} else {
				$('#ressources-level-2').removeClass('hidden');
			}

			$('#alert-credits-max').removeClass('hidden');
			$('.max-credits').html(credits);

			calculateTotal();

		});

	}


	/*******************************************************************************/
	/***  ADMIN News
	/*******************************************************************************/

	$('.table .sort-order').on('click', function(event) {
		$('#orderby').val( $(this).data('orderby') );
		$('#orderdir').val( $(this).data('orderdir') );

		$('#form-sort').submit();
	});

	$('.table button.edit').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();

		$('#id').val( $(this).data('id') );
		$('#form-edit').submit();

	});

	$('.table button.registrations').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();

		$('#form-show').find('input[name=id]').val( $(this).data('id') );
		$('#form-show').submit();

	});

	$(document).on('click', '.table tr.action', function(event) {
		$(this).find('button:first').click();
	});


	$('[data-toggle="tooltip"]').tooltip();

	$('.action button.lock').on('click', function(event){

		event.preventDefault();
		event.stopPropagation();

		var $self = $(this);
		var $id = $(this).data('id');
		var $url = $(this).data('url');
		var $tr = $(this).parents('.action');

		$.post($url, {'id' : $id}, function(data) {

			$tr.find('.lock').removeClass('hidden');
			$self.addClass('hidden');

			if (data == 1){
				$tr.find('.locked').html('<span class="text-danger"><i class="fa fa-lock" aria-hidden="true"></i></span>');
			} else {
				$tr.find('.locked').html('');
			}
		});
	
	});

	$(document).on('click', '.action button.delete', function(event){

		event.preventDefault();
		event.stopPropagation();

		var $id = $(this).data('id');
		var $url = $(this).data('url');
		var $tr = $(this).parents('.action');

		$('#confirm').modal({ backdrop: 'static', keyboard: false })
			.one('click', '#delete', function() {
				
			$.post($url, {'id' : $id}, function(data) {
				$tr.remove();
			});

		});
	
	});

	/*******************************************************************************/
	/***  ADMIN players
	/*******************************************************************************/

	$('button.tool').on('click', function(event){
		$('#'+$(this).data('modal')).modal({ backdrop: 'static', keyboard: false });
	});

	$(document).on('click', 'button.list-action', function(event){
		
		event.preventDefault();
		event.stopPropagation();

		$form = $('#'+$(this).data('form'));
		$form.attr('action', $(this).data('action'));
		$form.find('input[name="id"]').val($(this).data('id'));

		$form.submit();
	});

	

	$(window).unload(function() {
		if ($('.backlink').length > 0) {
			history.pushState(null, "", $('.backling:first').attr('href'));
		}
	});


	/*******************************************************************************/
	/***  ADMIN options
	/*******************************************************************************/
	$(document).on('click', '.component-precision button.btn-success', function(event) {
		event.preventDefault();
		event.stopPropagation();

		$component = $(this).parents('.component-precision');

		if ($component.find('input').val() != "") {
			$component.find('select').append($('<option>', {value:$component.find('input').val().capitalize(), text:$component.find('input').val().capitalize()}));
			$component.find('input').val('');
			$component.find('input').focus();

			$component.find('i.fa-trash').removeClass('fa-trash').addClass('fa-minus');
		}
	});

	$(document).on('keydown', '.component-precision input', function(event){ 
		$component = $(this).parents('.component-precision');
		var code = event.which;

		if(code==13){
			event.preventDefault();
			event.stopPropagation();
			$component.find('button.btn-success').click();

		}
	});

	
	$(document).on('click', '.component-precision button.btn-danger', function(event){

		event.preventDefault();
		event.stopPropagation();

		$component = $(this).parents('.component-precision');

		if ($component.find('select option').length == 0) {
			$component.remove();
			return false;
		}

		$component.find('select :selected').each(function(i, selected){ 
			$(selected).remove();
		});

		if ($component.find('select option').length == 0) {
			$component.find('i.fa-minus').removeClass('fa-minus').addClass('fa-trash');
		}

		$component.find('input').val('');
		$component.find('input').focus();
	});


	$(document).on('dblclick', '.component-precision select option', function(event){

		$component = $(this).parents('.component-precision');
		$component.find('input').val($(this).val());

		$(this).remove();
		$component.find('input').focus();

		if ($component.find('select option').length == 0) {
			$component.find('i.fa-minus').removeClass('fa-minus').addClass('fa-trash');
		}
	
	});

	$(document).on('click', '#add_precision', function(){
		var precision_name = prompt("Entrez le nom de la précision que vous voulez ajouter.\nPar exemple (Taille)", "");

		if (precision_name != null) {
			$clone = $('.template .component-precision').clone();
			$clone.find('.control-label').html(precision_name.capitalize());
			$clone.find('select').attr('name', 'precision['+precision_name.capitalize()+']');
			$clone.appendTo('#form_options .precision-container');
		}
	});

	if ($('textarea[name="options"]').length != 0) {

		if ($('textarea[name="options"]').first().val() != '') {
			obj = JSON.parse($('textarea[name="options"]').first().val());
			for (var item in obj) {
			
				$clone = $('.template .component-precision').clone();
				$clone.find('.control-label').html(item);
				$clone.find('select').attr('name', 'precision['+item+']');

				for (var index in obj[item]) {
					var value = obj[item][index];
					$clone.find('select').append($('<option>', {value:value, text:value}));
				}

				if ($clone.find('select option').length != 0) {
					$clone.find('i.fa-trash').removeClass('fa-trash').addClass('fa-minus');
				}
				$clone.appendTo('#form_options .precision-container');

			}
		}
	}

	$('#form_options').on('submit', function(){
		$('#mandatory').val('0');
		if ($('#mandatory-x').is(':checked')) $('#mandatory').val('1');
		
		$('#locked').val('0');
		if ($('#locked-x').is(':checked')) $('#locked').val('1');

		var $precision = {};
		$('.precision-container .component-precision').each(function(){
			var $array = [];

			$(this).find('option').each(function(index, element){
				$array.push(element.value);
			});

			$precision[$(this).find('.control-label').text()] = $array;
		});

		$('textarea[name="options"]').val(JSON.stringify($precision));

	});


	$('#form_maintenance').on('submit', function(){
		$('#lock_admins').val('0');
		if ($('#lock_admins-x').is(':checked')) $('#lock_admins').val('1');
		
		$('#lock_players').val('0');
		if ($('#lock_players-x').is(':checked')) $('#lock_players').val('1');
	});


	$('a.textures').on('click', function() {
		event.preventDefault();
		event.stopPropagation();

		$('#texture').val( $(this).data('path') );
		$('.textures').removeClass('active');
		$(this).addClass('active');
	});


	$('a.bumps').on('click', function() {
		event.preventDefault();
		event.stopPropagation();

		$('#bump').val( $(this).data('path') );
		$('.bumps').removeClass('active');
		$(this).addClass('active');
	});



	if ($('#form_character').length != 0) {

		$('button#rnd-name').on('click', function() {

			$.get($(this).data('url'), function( data ) {
				$( "input#name").val( data.name + ' ' + data.surname );
			});
		});

		$('button#rnd-skills').on('click', function() {
			$count = $('input[name=id_skill]').length;
			$index = Math.floor(Math.random() * $count);

			$('input[name=id_skill]:eq('+$index+')').click();
			
		});

		$('input[name=id_skill]').on('click', function() {
			
			$('.trois-talents').addClass('hidden');
			if ($(this).val() == '21') {
				$('.trois-talents').removeClass('hidden');
			}
		});

		$('button#rnd-feats').on('click', function() {
			
			$('input.checkbox_card:checked').click();


			$count = $('input.checkbox_card').length;
			$index = Math.floor(Math.random() * $count);
			$index2 = Math.floor(Math.random() * $count);

			if ($index!=0 && $index==$index2) $index2--;
			if ($index==0 && $index==$index2) $index2++;

			$('input.checkbox_card:eq('+$index+')').click();
			$('input.checkbox_card:eq('+$index2+')').click();

			if ( !$('.trois-talents').first().hasClass('hidden') ) {
				$index3 = Math.floor(Math.random() * $count);

				if ($index3==$index || $index3==$index2) Math.floor(Math.random() * $count);
				if ($index3==$index || $index3==$index2) Math.floor(Math.random() * $count);

				$('input.checkbox_card:eq('+$index3+')').click();
			}
			
		});

		$('button.char-choice').on('click', function() {
			
			if ($(this).data('open') == 'close') {

				$('#list-'+$(this).data('list')).show();
				$(this).data('open', 'open');
			} else {

				$('#list-'+$(this).data('list')).slideUp();
				$(this).data('open', 'close');
			}

		});

		$('input[name=id_corporation]').on('click', function(){

			$('.choice-corpo').data('open', 'close').hide();
			$('#list-corpo').slideUp();
			//$('#alert-corpo').hide();

			$('#btn_corpo_'+$(this).val()).show();

		});

		$('input[name=id_profession]').on('click', function(){

			$('.choice-prof').data('open', 'close').hide();
			$('#list-prof').slideUp();
			//$('#alert-prof').hide();

			$('#btn_prof_'+$(this).val()).show();

		});

		$('input[name=id_race]').on('click', function(){

			$('.choice-race').data('open', 'close').hide();
			$('#list-race').slideUp();
			//$('#alert-race').hide();

			$('#btn_race_'+$(this).val()).show();

		});

		$('#btn_char_stepback').on('click', function(){
			event.stopPropagation();
			$('#frm_char_stepback').submit();
		});

	}

});


if ($('#form_card').length) {


    var sqPaymentForm = new SqPaymentForm({

		applicationId: $('#applicationId').val(),
		inputClass: 'form-control',
		cardNumber: { elementId: 'sq-card-number', placeholder: "0000 0000 0000 0000" },
		cvv: { elementId: 'sq-cvv', placeholder: 'CVV' },
		expirationDate: { elementId: 'sq-expiration-date', placeholder: 'MM/AA'	},
		postalCode: { elementId: 'sq-postal-code', placeholder: 'Code Postal' },
		inputStyles: [ {fontSize: '14px', padding: '3px'}, {mediaMaxWidth: '400px', fontSize: '18px',} ],
		callbacks: {
			cardNonceResponseReceived: function(errors, nonce, cardData) {
				$('.card-error p').remove();
				$('.card-error').addClass('hidden');

				if (errors) {
					errors.forEach(function(error) {
						$('.card-error').append('<p>'+error.message+'</p>').removeClass('hidden');
					});
				} else {
		
					$('#card-nonce').val(nonce);
					$('#postal-code').val(cardData.billing_postal_code);

					$('#form_card').submit();
				}
			},
		
			unsupportedBrowserDetected: function() {
				// Alert the buyer that their browser is not supported
			}
		}
    });


	$('#save-card').on('click', function(event) {
		event.preventDefault();
		sqPaymentForm.requestCardNonce();
	});

}




