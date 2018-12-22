$(document).ready(function(e) {

	$('#form-add-user').on( "submit", function( event ) {
		event.preventDefault();
		checkEmail();
	});


	function checkEmail(){
		$.ajax({
		  type: 'POST',
		  url: "../ajax/checkEmail.php",
		  data:  $("#form-add-user").serialize(),
		  success: function(data){

			   if(data.success){
				   registerForm();
			   }else{
				   $('.callout.alert').html(data.error).slideDown();
			   }

		   }
		});
	}

	function registerForm(){

		$.ajax({
		  type: 'POST',
		  url: "../ajax/user-add.php",
		  data:  $("#form-add-user").serialize(),
		  success: function(data){

			  $('.callout.alert').html(data.message).slideDown();

			  setTimeout(function(){
				 $('.callout.alert').slideUp();
			   }, 2000);

			   if(data.success){
				   $('#form-add-user').trigger("reset");
			   }

		   }
		});

	}


});
