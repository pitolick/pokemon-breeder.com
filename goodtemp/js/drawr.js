jQuery(function($) {
	$(function(){
		$("#toggle").click(function(){
			$(".primary").slideToggle();
			return false;
		});
		$(window).resize(function(){
			var win = $(window).width();
			var p = 640; //ドロワーメニューに変更する画面幅
			if(win > p){
				$(".primary").show();
			} else {
				$(".primary").hide();
			}
		});
	});
});