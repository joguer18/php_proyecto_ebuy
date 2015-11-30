$(document).ready(function(){
	var menuHeight = $("#header .header-bot .main-menu").height();
	$("#responsive-menu").toggle(function(){
		$("#header div.header-top").css("border-top","0px");
		$("#header .header-top").animate({"margin-top":menuHeight+"px"}, 500);
		setTimeout(function(){
			$("#header .header-bot .main-menu").css("z-index","999");
		}, 500);
	},function(){
		$("#header .header-bot .main-menu").css("z-index","-999");
		$("#header .header-top").animate({"margin-top":"0"}, 500);
		setTimeout(function(){
			$("#header div.header-top").css("border-top","3px solid #"+globalColor);
		}, 450);
	});
	$(window).resize(function(){
		menuHeight = $("#header .header-bot .main-menu").height();
		var screenWidth = $(window).width();
		if(screenWidth > 767){
			$("#header .header-bot .main-menu").css("z-index","-999");
			$("#header .header-top").animate({"margin-top":"0"}, 0);
		}
	});
});