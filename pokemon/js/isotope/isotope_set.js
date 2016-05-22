jQuery(function( $ ) {
/* おまじない開始 */
$(function() {
	var $container = $('.isotope');

	/* 読み込み時50音順に.currentを付与 */
	$('.sort .filter li:first-child a').addClass('current');
	$('.battle_btn-wrap p.battle_btn:first-child a').addClass('current');

	/* isotopeの動作を設定 */
	$container.isotope({
		itemSelector: '.item',
		percentPosition: true,
		masonry: {
			columnWidth: '.pokeitem',
			gutter: '.gutter-sizer'
		},
		getSortData: {
			name: '.pokemon_name', // 文字
			number: '.pokemon_number parseInt', //数値
			speed: '.pokemon_s parseInt' //数値
		},
		sortAscending: {
			speed: false // 降順に
		}
	});

 // store filter for each group
	var filters = {};

	$('.controler .filter .iso_btn').click(function() {
		var $this = $(this);
		// get group key
		var $buttonGroup = $this.parents('.filter');
		var filterGroup = $buttonGroup.attr('data-filter-group');
		// set filter for group
		filters[ filterGroup ] = $this.attr('data-filter');
		// combine filters
		var filterValue = concatValues( filters );
		// set filter for Isotope
		$container.isotope({
			filter: filterValue,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
	});

// flatten object by concatting values
function concatValues( obj ) {
	var value = '';
	for ( var prop in obj ) {
		value += obj[ prop ];
	}
	return value;
}

	/* フィルターボタンを押した時の動作 */
/*	$('.controler .filter li a').click(function(){
		$('.controler .filter .current').removeClass('current');
		$(this).addClass('current');

		var selector = $(this).attr('data-filter');
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
		return false;
	});
*/
	/* フィルターボタン(バトルポケモン)を押した時の動作 */
	$('.controler .battle_btn a').click(function(){
		$('.controler .battle_btn .current').removeClass('current');
		$(this).addClass('current');

/*		var selector_battle = $(this).attr('battle_poke-filter');
		$container.isotope({
			filter: selector_battle,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
*/		return false;
	});

	/* フィルターセレクトを使用した時の動作 */
	$('.filters-select').on( 'change', function() {
/*    var filterValue = this.value;
		// use filterFn if matches value
		$container.isotope({
			filter: filterValue,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
		return false;
*/
		var $this = $(this);
		// get group key
		var $buttonGroup = $this.parents('.filter');
		var filterGroup = $buttonGroup.attr('data-filter-group');
		// set filter for group
		filters[ filterGroup ] = this.value;

		// combine filters
		var filterValue = concatValues( filters );
		// set filter for Isotope
		$container.isotope({
			filter: filterValue,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});
		return false;
	});

	/* ソートボタンを押した時の動作 */
	$('.sort .filter a').click(function(){
		$('.sort .filter .current').removeClass('current');
		$(this).addClass('current');

		var sortValue = $(this).attr('data-sort-value');
		$container.isotope({ sortBy: sortValue });

		return false;
	});

});

/* おまじない終了 */
});