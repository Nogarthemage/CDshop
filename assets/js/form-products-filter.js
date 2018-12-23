$(document).ready(function(e) {

	$('#form-search').on( "submit", function( event ) {
		event.preventDefault();
		filterProducts();
	});

	$('input[type=radio][name=param_sort]').change(function(){
		event.preventDefault();
		filterProducts();
	});

	$('input[type=checkbox]').change(function(){
		event.preventDefault();
		filterProducts();
	});


	function filterProducts(){
		$.ajax({
		  type: 'POST',
		  url: "ajax/product-filter.php",
		  data:  $("#form-search, #form-sort, #form-filter").serialize(),
		  dataType:"json",
		  success: function(data){
				  //console.log(JSON.stringify(data));

				  var source  			 	= document.getElementById("list-products-filtered").innerHTML;
				  var compiledTemplate 		= Handlebars.compile(source);
				  var generatedHTML    		= compiledTemplate(data);

				  var destinationList   = document.getElementById("productlist");
				  destinationList.innerHTML = generatedHTML;

				  

			  }

		  });

	}


});
