$(function (){
	$(".navbar a, footer a").on("click", function(event){
		event.preventDefault();
		var hash = this.hash;
		$('body').animate({scrollTop: $(hash).offset().top}, 900, function(){window.location.hash = hash;})
	});
	$('#contact-form').submit(function(e){
		e.preventDefault();
		$('.comments').empty();
		var postdata = $('#contact-form').serialize();
		$.ajax({
			type: 'POST',
			url: 'php/contact.php',
			data: postdata,
			dataType: 'json',
			success: function(result){
				if (result.isSuccess) {
					$("#contact-form").append("<p class='thank-you'>Your message has been sent. thank you for contacting me :)</p>");
					$("#contact-form")[0].reset();
				}
				else{
					$("#firstname + .comments").html(result.firstnameERR);
					$("#name + .comments").html(result.nameERR);
					$("#email + .comments").html(result.emailERR);
					$("#phone + .comments").html(result.phoneERR);
					$("#message + .comments").html(result.messageERR);
				}
			}
		});
	});
})