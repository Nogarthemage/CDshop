$(document).ready(function(e) {

	$('.form-remove-product').on( "submit", function( event ) {
		event.preventDefault();

		var tableRow = $(this).parent().parent();
		$.ajax({
		  type: 'POST',
		  url: "../ajax/product-remove.php",
		  data:  $(this).serialize(),
		  success: function(data){

			   if(data.success){
				   $('.callout.alert').html(data.message).slideDown();
				   tableRow.remove();
			   }else{
				   $('.callout.alert').html(data.message).slideDown();
			   }

		   }
		});

	});





});
