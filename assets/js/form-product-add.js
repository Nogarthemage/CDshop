$(document).ready(function(e) {

	$('#form-add-product').on( "submit", function( event ) {
		event.preventDefault();
		addProduct();
	});

	function addProduct(){

		$.ajax({
		  type: 'POST',
		  url: "../ajax/product-add.php",
		  data:  $("#form-add-product").serialize(),
		  success: function(data){

			  $('.callout.alert').html(data.message).slideDown();

			  setTimeout(function(){
				 $('.callout.alert').slideUp();
			   }, 2000);

			   if(data.success){
				 $('#form-add-product').trigger("reset");
			   }


		   }
		});

	}


});
