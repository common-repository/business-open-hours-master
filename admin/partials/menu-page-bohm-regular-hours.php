<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://icanwp.com/plugins/business-open-hours-master/
 * @since      1.0.0
 *
 * @package    Business_Open_Hours_Master
 * @subpackage Business_Open_Hours_Master/admin/partials
 */

if ( $_POST['action'] == 'Save' ){
	$result = $_POST['bohm_hour_set'];
	if(!empty($result)){
		$save_option = json_encode($result);
		update_option('bohm_regular_hours', $save_option);
	} else {
		update_option('bohm_regular_hours', array());
	}
}
?>
<div id="bohm-regular-hour-main-page" class="wrap bohm-admin-page">
	<div class="bohm-page-left">
		<h2>Regular Business Open Hours <button id="add-new-regular-hours" class="add-new-h2">Add New Set of Hours</button></h2>
		<form method="post">
			<table class="table-bohm-regualr-hours">
				<tbody class="tbody-bohm-regualr-hours">
			<?php
				$bohm_regular_hours = get_option('bohm_regular_hours');
				if (!empty($bohm_regular_hours)) {
					$bohm_regular_hours = json_decode($bohm_regular_hours, true);
					$i = 0;
					foreach($bohm_regular_hours as $bohm_hour){
						echo display_bohm_regular_hours_set($bohm_hour, $i);
						$i++;
					}
				}
			?>
				</tbody>
			</table>
			<input type="submit" class="button button-primary" name="action" value="Save" />
		</form>
	</div>
	<div class="bohm-page-right">
		<h3>Color Guide</h3>
		<div class="bohm-color-codes">
			<div class="bohm-saved">
				<p>Saved</p>
			</div>
			<div class="bohm-not-saved">
				<p>Not Saved</p>
			</div>
		</div>
		<h3>Preview</h3>
		<div class="bohm-hours-display">
			<?php
				if (!empty($bohm_regular_hours)) {
					$i = 0;
					foreach($bohm_regular_hours as $bohm_hour){
						echo public_display_bohm_regular_hours_set($bohm_hour);
						$i++;
					}
				}
			?>
		</div>
		<h3>Shortcodes</h3>
		<div class="bohm-shortcodes-info">
			<p><span class="bohm-shortcodes-highlight">&#91;show-business-hours&#93;</span></p>
		</div>
	</div>
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
	
function display_bohm_regular_hours_set($bohm_hour, $i){
		$html = '
		<tr class="tr-bohm-regualr-hours">
			<td class="td-bohm-regualr-hours">
				<div class="bohm-grabber">
					<img src="' . plugin_dir_url( __FILE__ ) . '../assets/grabber.png' . '" />
				</div>
				<div class="bohm-time-set-control bohm-time-set-main">
					<div class="bohm-time-set-control-title">
						<label>Title:</label>
						<input type="text" class="bohm-time-set-title bohm-field" name="bohm_hour_set['.$i.'][title]" value="' . $bohm_hour["title"] . '" />
					</div>
					<div class="bohm-time-set-control-display">
						<label>Hide Title Display:</label>
						<input type="checkbox" class="bohm-time-set-hide-title bohm-field" name="bohm_hour_set['.$i.'][display]" value="Display" ' . (isset($bohm_hour["display"]) ? "checked" : "")   . ' />
					</div>
					<button class="bohm-time-set-main-delete">Delete</button>
				</div>
				<div class="time-set-control time-set-detail">
					<div class="time-range">
						<input type="text" class="time-start bohm-field" name="bohm_hour_set['.$i.'][time_start]" value="'.$bohm_hour["time_start"].'" /> ~ <input type="text" class="time-end bohm-field" name="bohm_hour_set['.$i.'][time_end]" value="'.$bohm_hour["time_end"].'" />
					</div>
					<div class="days">
						<div class="bohm-day"> 
							<label>Mon</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][mon]" value="Monday" ' . (isset($bohm_hour["mon"]) ? "checked" : "")  . ' />
						</div>
						<div class="bohm-day"> 
							<label>Tue</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][tue]" value="Tuesday" ' . (isset($bohm_hour["tue"]) ? "checked" : "")  . ' />
						</div>
						<div class="bohm-day"> 
							<label>Wed</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][wed]" value="Wednesday" ' . (isset($bohm_hour["wed"]) ? "checked" : "")  . ' />
						</div>
						<div class="bohm-day"> 
							<label>Thu</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][thu]" value="Thursday" ' . (isset($bohm_hour["thu"]) ? "checked" : "")  . ' />
						</div>
						<div class="bohm-day"> 
							<label>Fri</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][fri]" value="Friday" ' . (isset($bohm_hour["fri"]) ? "checked" : "")  . ' />
						</div>
						<div class="bohm-day">
							<label>Sat</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][sat]" value="Saturday" ' . (isset($bohm_hour["sat"]) ? "checked" : "")  . ' />
						</div>
						<div class="bohm-day"> 
							<label>Sun</label>
							<input type="checkbox" class="bohm-field" name="bohm_hour_set['.$i.'][sun]" value="Sunday" ' . (isset($bohm_hour["sun"]) ? "checked" : "")  . ' />
						</div>
					</div>
				</div>
			</td>
		</tr>';
		return $html;
	}
?>