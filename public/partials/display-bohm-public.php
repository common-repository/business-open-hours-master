<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://icanwp.com/plugins/business-open-hours-master/
 * @since      1.0.0
 *
 * @package    Business_Open_Hours_Master
 * @subpackage Business_Open_Hours_Master/public/partials
 */
?>
<div class="bohm-hours-display">
	<?php
		$bohm_regular_hours = get_option('bohm_regular_hours');
		if (!empty($bohm_regular_hours)) {
			$bohm_regular_hours = json_decode($bohm_regular_hours, true);
			$i = 0;
			foreach($bohm_regular_hours as $bohm_hour){
				echo public_display_bohm_regular_hours_set($bohm_hour);
			}
		} else {
			echo "No Business Hours are specified.";
		}
	?>
</div>

<?php
	function public_display_bohm_regular_hours_set($bohm_hour){
		$html = '';
		$arr_days = array($bohm_hour["mon"],$bohm_hour["tue"],$bohm_hour["wed"],$bohm_hour["thu"],$bohm_hour["fri"],$bohm_hour["sat"],$bohm_hour["sun"]);
		
		if(!isset($bohm_hour["display"])) { //if set to display the title
			$html = '<div class="bohm-regular-hours-title">' . $bohm_hour["title"] . '</div>';
		}
		if(count(array_filter($arr_days)) > 0){ //if one or more days are selected
			$html .= '
			<div class="bohm-regular-hours-detail">
				<div class="bohm-regular-hours-days">' .
					get_bohm_days($arr_days) .
				'</div>
				<div class="bohm-regular-hours-time">' .
					$bohm_hour["time_start"] . '-' . $bohm_hour["time_end"] .
				'</div>
			</div>
			';
		}
		return $html;
	}
	
	function get_bohm_days($arr_days){
		
		$html = '';
		for($i = 0; $i < 7; $i++){
			if(!empty($arr_days[$i])){
				if(!empty($arr_days[$i + 1])){
					if(empty($arr_days[$i - 1])){
						$html .= substr($arr_days[$i], 0, 3) . '-';
					}
				} else {
					$html .= substr($arr_days[$i], 0, 3) . ', ';
				}
			}				
		}
		$html = substr($html, 0, -2) . ": ";
		
		return $html;
	}
?>