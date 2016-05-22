jQuery(function($) {
	$(function(){
		$("#toggle").click(function(){
			$(".primary").slideToggle();
			return false;
		});
		$(window).resize(function(){
			var win = $(window).width();
			var p = 768; //ドロワーメニューに変更する画面幅 元：640
			if(win > p){
				$(".primary").show();
			} else {
				$(".primary").hide();
			}
		});
	});
});