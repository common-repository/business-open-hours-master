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
?>

<div class="wrap">
	<form method="post" action="options.php">
		<?php settings_fields( 'bohm_settings_menu' ); ?>
		<?php do_settings_sections( 'bohm_settings_menu' ); ?> 
		<?php submit_button(); ?>
	</form>
</div>