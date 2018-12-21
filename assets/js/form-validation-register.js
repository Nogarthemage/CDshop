$(document).ready(function(e) {

	$("#registrationform").on( "submit", function( event ) {
			event.preventDefault();

			var valid = true;

			var firstname 		= $('input[name="firstname"]');
			var lastname		= $('input[name="lastname"]');
			var email 			= $('input[name="email"]');
			var password 		= $('input[name="password"]');

			if ( firstname.val() === "" ){
				valid = false;
				firstname.addClass('errorfound');
			}else{
				firstname.removeClass('errorfound');
			}


			if ( lastname.val() === "" ){
				valid = false;
				lastname.addClass('errorfound');
			}else{
				lastname.removeClass('errorfound');
			}


			if ( email.val() === "" )
			{
				email.addClass('errorfound');
				valid = false;
			} else {
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				var addressVal = email.val();
				if(reg.test(addressVal) === false) {
					email.addClass('errorfound');
					valid = false;
					return;
				}else{
					email.removeClass('errorfound');
				}

			}

			if ( password.val() === "" ){
				valid = false;
				password.addClass('errorfound');
			}else{
				password.removeClass('errorfound');
			}


			if(valid){
				$('.errorfield').slideUp();
				checkEmail();
			}else{
				 $('.errorfield .callout').html('Please fill in all the fiels.');
				$('.errorfield').slideDown();
			}

		});

		function checkEmail(){
			$.ajax({
			  type: 'POST',
			  url: "ajax/checkEmail.php",
			  data:  $("#registrationform").serialize(),
			  success: function(data){

				   if(data.success){
					   $('.errorfield').slideUp();
					   registerForm();
				   }else{
					   $('.errorfield').slideDown();
					   $('.errorfield .callout').html(data.error);
				   }

			   }
			});
		}

		function registerForm(){
			$.ajax({
			  type: 'POST',
			  url: "ajax/registerUser.php",
			  data:  $("#registrationform").serialize(),
			  success: function(data){

				   if(data.success){
					   	$('#registrationform').slideUp();
   						$('.form-success').slideDown();
				   }else{
					   //$('#registrationform').slideUp();
					   $('.form-error').slideDown();
				   }

			   }
			});
		}


});
