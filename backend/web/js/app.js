$(function() {
	"use strict";

	$('.wt-dropdown-select').change(function(e) {
		if( $(e.target).attr('name') === 'choice_sites_dropdown' ) {
			var siteId = $(e.target).val();

			if( siteId ) {
				window.location = '/admin/sites/default/choice?' +
				'site_id=' + siteId
			}
		}
	});

	//Make the dashboard widgets sortable Using jquery UI
	/*$(".connectedSortable").sortable({
	 placeholder: "sort-highlight",
	 connectWith: ".connectedSortable",
	 handle: ".box-header, .nav-tabs",
	 forcePlaceholderSize: true,
	 zIndex: 999999
	 }).disableSelection();
	 $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");*/
});