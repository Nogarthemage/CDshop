$(document).ready(function(e) {

	$('#form-edit-product').on( "submit", function( event ) {
		event.preventDefault();
		updateProduct();
	});


	function updateProduct(){

		$.ajax({
		  type: 'POST',
		  url: "../ajax/product-edit.php",
		  data:  $("#form-edit-product").serialize(),
		  success: function(data){

			   $('.callout.alert').html(data.message).slideDown();

			   setTimeout(function(){
				  $('.callout.alert').slideUp();
				}, 2000);


		   }
		});

	}


});
