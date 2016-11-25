<form method="post" action="options.php">
	<?php settings_fields( 'google-analytics-tracking-info' ); ?>
    	<?php do_settings_sections( 'google-analytics-tracking-info' ); ?>
	<h1>Google Analytics Link</h1>
	<br/>
	<h3>Plugin configurations</h3>
	<table class="form-table">
		<tr>
    		<th scope="row">
    			<label for="ga-link">Tracking Code:</label>
    		</th>
			<td>
            	<input id="ga-link" name="ga_tracking_code" type="text" value="<?php echo get_option('ga_tracking_code'); ?>" placeholder="Tracking Code"/>
			</td>
		</tr>
	</table>
	<?php submit_button(); ?>
</form>
