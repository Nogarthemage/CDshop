$(document).ready(function(e) {

	$('#form-edit-user').on( "submit", function( event ) {
		event.preventDefault();
		updateUser();
	});


	function updateUser(){

		$.ajax({
		  type: 'POST',
		  url: "../ajax/user-edit.php",
		  data:  $("#form-edit-user").serialize(),
		  success: function(data){

			   $('.callout.alert').html(data.message).slideDown();

			   setTimeout(function(){
				  $('.callout.alert').slideUp();
				}, 2000);


		   }
		});

	}


});
