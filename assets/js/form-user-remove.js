$(document).ready(function(e) {

	$('.button-remove').on( "click", function( event ) {
		event.preventDefault();

		var tableRow = $(this).parent().parent();
		var userid = $(this).data('userid');
		console.log('userid: ' + userid);


		$.ajax({
		  type: 'POST',
		  url: "../ajax/user-remove.php",
		  data:  { userid: userid},
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
