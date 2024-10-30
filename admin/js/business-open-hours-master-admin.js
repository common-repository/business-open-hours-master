jQuery.noConflict();
jQuery(document).ready(function( $ ) {
	var numItems = $('.tr-bohm-regualr-hours').length;
	var count = numItems + 1;
	$("#add-new-regular-hours").on("click", function() {
		count++;		
		var timeSets = 
		'<tr class="tr-bohm-regualr-hours">' +
			'<td class="td-bohm-regualr-hours">' +
				'<div class="bohm-grabber">' +
					'<img src="' + bohm_admin_localized.plugin_admin_url + 'assets/grabber.png" />' +
				'</div>' +
				'<div class="bohm-time-set-control bohm-time-set-main">' +
					'<div class="bohm-time-set-control-title">' +
						'<label>Title:</label>' +
						'<input type="text" class="bohm-time-set-title bohm-field" name="bohm_hour_set['+ count +'][title]" />' +
					'</div>' +
					'<div class="bohm-time-set-control-display">' +
						'<label>Hide Title Display:</label>' +
						'<input type="checkbox" class="bohm-time-set-hide-title bohm-field" name="bohm_hour_set['+ count +'][display]" />' +
					'</div>' +
					'<button class="bohm-time-set-main-delete">Delete</button>' +
				'</div>' +
				'<div class="time-set-control time-set-detail">' +
					'<div class="time-range">' +
						'<input type="text" class="time-start bohm-field" name="bohm_hour_set['+ count +'][time_start]" /> ~ <input type="text" class="time-end bohm-field" name="bohm_hour_set['+ count +'][time_end]" />' +
					'</div>' +
					'<div class="days">' +
						'<div class="bohm-day">' +
							'<label>Mon</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][mon]" value="Monday" />' +
						'</div>' +
						'<div class="bohm-day">' +
							'<label>Tue</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][tue]" value="Tuesday" />' +
						'</div>' +
						'<div class="bohm-day">' +
							'<label>Wed</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][wed]" value="Wednesday" />' +
						'</div>' +
						'<div class="bohm-day">' +
							'<label>Thu</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][thu]" value="Thursday" />' +
						'</div>' +
						'<div class="bohm-day">' +
							'<label>Fri</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][fri]" value="Friday" >' +
						'</div>' +
						'<div class="bohm-day">' +
							'<label>Sat</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][sat]" value="Saturday" />' +
						'</div>' +
						'<div class="bohm-day">' +
							'<label>Sun</label>' +
							'<input type="checkbox" class="bohm-field" name="bohm_hour_set['+ count +'][sun]" value="Sunday" />' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</td>' +
		'</tr>';

		$("tbody.tbody-bohm-regualr-hours").append(timeSets);
		$('input.time-start').timepicker({
			showPeriod: true,  
			showPeriodLabels: true,
			showCloseButton: true,
			closeButtonText: 'Done'
		});
		$('input.time-end').timepicker({
			showPeriod: true,  
			showPeriodLabels: true,
			showCloseButton: true,
			closeButtonText: 'Done'
		});
	});
	$('input.time-start').timepicker({
			showPeriod: true,  
			showPeriodLabels: true,
			showCloseButton: true,
			closeButtonText: 'Done'
		});
	$('input.time-end').timepicker({
		showPeriod: true,  
		showPeriodLabels: true,
		showCloseButton: true,
		closeButtonText: 'Done'
	});
	$('.tbody-bohm-regualr-hours').sortable();
	$('.tbody-bohm-regualr-hours').disableSelection();
	
	$(document).on("click", ".bohm-time-set-main-delete", function() {
		$(this).closest("tr").remove();
		event.preventDefault();
	});
});