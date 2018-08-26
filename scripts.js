$(function(){
	$.ajax({
		url:"home.php",
		success: function(data){
			$('.content').html(data);
		}
	});
});

$('#home').click(function(){
	$.ajax({
		url:"home.php",
		success: function(data){
			$('.content').html(data);
		}
	});
});

$('#services').click(function(){
	$.ajax({
		url:"services.php",
		success: function(data){
			$('.content').html(data);
		}
	});
});

$('#testimonials').click(function(){
	$.ajax({
		url:"testimonials.php",
		success: function(data){
			$('.content').html(data);
		}
	});
});

$('#about').click(function(){
	$.ajax({
		url:"about.php",
		success: function(data){
			$('.content').html(data);
		}
	});
});

$('#contact').click(function(){
	$.ajax({
		url:"contact.php",
		success: function(data){
			$('.content').html(data);
		}
	});
});
