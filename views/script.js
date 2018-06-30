$(document).ready(function(){
	
	//TODO:implement flags, currently removes row
	$(".flagButton").on("click", function(e){
		$(this).closest("tr").hide();
	})

	//clears row on city page
	$(".clearButton").on("click", function(e){
		$(this).closest("tr").hide();
	})

	
})