
$(document).ready(function(){
  $(".menuTopList ul li").hover(function(){
	$(this).addClass('currentMenu');
	$(this).find("div").css({"display":"block"});
  }, function(){
    $(this).removeClass('currentMenu');
	$(this).find("div").css({"display":"none"});
  });
});