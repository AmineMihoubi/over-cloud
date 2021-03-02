 $("#login-button").click(function(event){
		 event.preventDefault();
	 
	 $('form').fadeOut(500);
	 $('.wrapper').addClass('form-success');
});

$("#goto-subscribe").click(function(event){
		 event.preventDefault();
	 	window.location.href = "./inscription.html";
});