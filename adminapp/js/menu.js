$(document).ready(function(){
	$("h2").click(function(){
		$(this).parent().find("ul").toggle();
	})
});