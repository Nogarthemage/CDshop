$(document).ready(function(e) {

	$('.product-button-wrapper').on( "click", ".button-add-product", function( event ) {
		event.preventDefault();
		var productid = $(this).data('productid');
		var button = $(this);

		$.ajax({
		  type: 'POST',
		  url: "ajax/shoppingcart-add.php",
		  data:  {productid: productid},
		  success: function(data){

			  button.html('Product added');

			  setTimeout(function(){
				button.html('<i class="fas fa-shopping-cart"></i> Add to cart');
			  }, 2000);


		   }
		});
	});


});
