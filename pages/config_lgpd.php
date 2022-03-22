<form method="post" action="options.php">

	<table class="form-table">
		
		<?php do_settings_sections('LGPD_dados_registro'); ?>
		<?php settings_fields('LGPD_dados_registro'); ?>
		<?php submit_button(); ?>

	</table>
</form>