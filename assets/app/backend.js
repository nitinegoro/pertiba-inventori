jQuery(function($) {
	var $sidebar = $('.sidebar').eq(0);
	if( !$sidebar.hasClass('h-sidebar') ) return;
			
	$(document).on('settings.ace.top_menu' , function(ev, event_name, fixed) {
		if( event_name !== 'sidebar_fixed' ) return;
			
		var sidebar = $sidebar.get(0);
		var $window = $(window);
			
		//return if sidebar is not fixed or in mobile view mode
		var sidebar_vars = $sidebar.ace_sidebar('vars');
		if( !fixed || ( sidebar_vars['mobile_view'] || sidebar_vars['collapsible'] ) ) {
			$sidebar.removeClass('lower-highlight');
			//restore original, default marginTop
			sidebar.style.marginTop = '';
			
			$window.off('scroll.ace.top_menu')
			return;
		}
			
			
		var done = false;
		$window.on('scroll.ace.top_menu', function(e) 
		{
			
			var scroll = $window.scrollTop();
			scroll = parseInt(scroll / 4);//move the menu up 1px for every 4px of document scrolling
			if (scroll > 17) scroll = 17;
			
			
			if (scroll > 16) {			
				if(!done) {
					$sidebar.addClass('lower-highlight');
					done = true;
				}
			}
			else {
				if(done) {
					$sidebar.removeClass('lower-highlight');
					done = false;
				}
			}
			
			sidebar.style['marginTop'] = (17-scroll)+'px';
		}).triggerHandler('scroll.ace.top_menu');
			
	}).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
			
	$(window).on('resize.ace.top_menu', function() {
		$(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
	});

	$('[data-rel=tooltip]').tooltip({container:'body'});
	$('[data-rel=popover]').popover({container:'body'});

	$('table').tableCheckbox({
		selectedRowClass: 'danger',
		checkboxSelector: 'td:first-of-type input[type="checkbox"],th:first-of-type input[type="checkbox"]',
		isChecked: function($checkbox) {
			return $checkbox.is(':checked');
		}
	});

	

	//And for the first simple table, which doesn't have TableTools or dataTables
	//select/deselect all rows according to table header checkbox
	var active_class = 'active';
	$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
		var th_checked = this.checked;//checkbox inside "TH" table header
					
		$(this).closest('table').find('tbody > tr').each(function(){
			var row = this;
			if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
			else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
		});
	});
				
	//select/deselect a row when the checkbox is checked/unchecked
	$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
		var $row = $(this).closest('tr');
		if($row.is('.detail-row ')) return;
		if(this.checked) $row.addClass(active_class);
		else $row.removeClass(active_class);
	});

	$('.show-details-btn').on('click', function(e) {
		e.preventDefault();
		$(this).closest('tr').next().toggleClass('open');
		$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
	});

	// Show or hide the sticky footer button
	$(window).scroll(function() {
		if ($(this).scrollTop() > 300) {
			$('.go-top').fadeIn(200);
		} else {
			$('.go-top').fadeOut(200);
		}
	});
			
	// Animate the scroll to top
	$('.go-top').click(function(event) {
		event.preventDefault();
				
		$('html, body').animate({scrollTop: 0}, 300);
	});
});