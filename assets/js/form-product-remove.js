$(document).ready(function(e) {

	$('.button-remove').on( "click", function( event ) {
		event.preventDefault();

		var tableRow = $(this).parent().parent();
		var productid = $(this).data('productid');
		console.log('productid: ' + productid);


		$.ajax({
		  type: 'POST',
		  url: "../ajax/product-remove.php",
		  data:  { productid: productid},
		  success: function(data){

			   if(data.success){
				   $('.callout.alert').html(data.message).slideDown();
				   tableRow.remove();
				   setTimeout(function(){
					 $('.callout.alert').slideUp();
				   }, 2000);
			   }else{
				   $('.callout.alert').html(data.message).slideDown();
			   }

		   }
		});


	});


});
