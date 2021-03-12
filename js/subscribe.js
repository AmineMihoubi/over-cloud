 function redirectToLogin(){
		 
	var done = $("#done").val();
	console.log(done);
	if(done == 'true'){
		$('form').fadeOut(500);
		$('.wrapper').addClass('form-success');
	}
}

$("#goto-login").click(function(event){
		 event.preventDefault();
	 	window.location.href = "./index.php";
});