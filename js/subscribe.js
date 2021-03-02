 $("#sub-button").click(function(event){
		 event.preventDefault();
	 
	 $('form').fadeOut(500);
	 $('.wrapper').addClass('form-success');
});

$("#goto-login").click(function(event){
		 event.preventDefault();
	 	window.location.href = "./index.html";
});