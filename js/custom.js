$(document).ready(function() {
	$('#js-submit-button').on('click', function(e) {
        e.preventDefault();
        $('#roman-form').append('<input type="hidden" name="js-submit" id="js-submit" value="submit" />');
        var formData = $('#roman-form').serialize();
		$.ajax({
			url : 'Roman.php',
			type : 'POST',
			data  : formData,
			success : function(response){
				response = jQuery.parseJSON(response);
				var message = '';
				var alertClass = 'alert-success'; 
				if (response.message) {
					message = response.message;
					alertClass = 'alert-danger';
				} else if (response.result) {
					message = 'The calculated value is '+response.result;
				}

				$('#roman-form #js-submit').remove();
				$('.container .alert').remove();
				$('.container').prepend('<div class="alert alert-dismissible '+alertClass+' fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+message+'</div>');
			},
			error : function(response) {
				console.log('There is an error. please check.');
			}

		})
	});
});