$(document).ready(function(e) {

	$('.button-add-product').on( "click", function( event ) {
		event.preventDefault();
		var productid = $(this).data('productid');

		$.ajax({
		  type: 'POST',
		  url: "ajax/shoppingcart-add.php",
		  data:  { productid: productid},
		  success: function(data){

			  alert('product added');

			  /*
			  $('.callout.alert').html(data.message).slideDown();

			  setTimeout(function(){
				 $('.callout.alert').slideUp();
			   }, 2000);

			   if(data.success){
				 $('#form-add-product').trigger("reset");
			 }*/


		   }
		});


	});


});
