$(document).ready(function(e) {


	$("#form-place-order").on( "submit", function( event ) {
			event.preventDefault();

			var valid = true;

			var firstname 		= $('input[name="firstname"]');
			var lastname		= $('input[name="lastname"]');
			var address 		= $('textarea[name="shippingaddress"]');

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


			if ( address.val() === "" ){
				valid = false;
				address.addClass('errorfound');
			}else{
				address.removeClass('errorfound');
			}


			if(valid){
				$('.errorfield').slideUp();
				placeOrder();
			}else{
				 $('.errorfield .callout').html('Please fill in all the fields.');
				$('.errorfield').slideDown();
			}

		});

		function placeOrder(){
			$.ajax({
			  type: 'POST',
			  url: "ajax/placeOrder.php",
			  data:  $("#form-place-order").serialize(),
			  success: function(data){

				   if(data.success){
					   	$('#form-place-order').slideUp();
   						$('.form-success').slideDown();
						$('#shoppingcartlist').slideUp();

				   }else{
					   //$('#registrationform').slideUp();
					   $('.form-error').slideDown();
				   }

			   }
			});
		}


});
