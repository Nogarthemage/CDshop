$(document).ready(function(e) {

	$('.button-remove-product').on( "click", function( event ) {
		event.preventDefault();
		var productid = $(this).data('productid');

		$.ajax({
		  type: 'POST',
		  url: "ajax/shoppingcart-remove.php",
		  data:  { productid: productid},
		  success: function(data){
			   location.reload();
		   }
		});


	});


});
