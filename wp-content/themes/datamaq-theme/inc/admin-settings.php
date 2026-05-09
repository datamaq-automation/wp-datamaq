<?php
/**
 * DataMaq Admin Settings - ChatWoot Integration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the settings menu
 */
add_action( 'admin_menu', function () {
	add_options_page(
		'ChatWoot Integration',
		'ChatWoot Integration',
		'manage_options',
		'chatwoot-settings',
		'datamaq_render_chatwoot_settings'
	);
} );

/**
 * Register settings, sections and fields
 */
add_action( 'admin_init', function () {
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_base_url' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_account_id' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_inbox_id' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_api_token' );

	add_settings_section(
		'chatwoot_main_section',
		'ChatWoot API Configuration',
		function () {
			echo '<p>Configure las credenciales para la conexión directa con ChatWoot.</p>';
		},
		'chatwoot-settings'
	);

	add_settings_field(
		'datamaq_chatwoot_base_url',
		'Base URL',
		function () {
			$val = get_option( 'datamaq_chatwoot_base_url', 'https://app.chatwoot.com' );
			echo '<input type="text" name="datamaq_chatwoot_base_url" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="https://app.chatwoot.com" />';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);

	add_settings_field(
		'datamaq_chatwoot_account_id',
		'Account ID',
		function () {
			$val = get_option( 'datamaq_chatwoot_account_id' );
			echo '<input type="text" name="datamaq_chatwoot_account_id" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="1" />';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);

	add_settings_field(
		'datamaq_chatwoot_inbox_id',
		'Inbox ID',
		function () {
			$val = get_option( 'datamaq_chatwoot_inbox_id' );
			echo '<input type="text" name="datamaq_chatwoot_inbox_id" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="123" />';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);

	add_settings_field(
		'datamaq_chatwoot_api_token',
		'Access Token',
		function () {
			$val = get_option( 'datamaq_chatwoot_api_token' );
			echo '<input type="password" name="datamaq_chatwoot_api_token" value="' . esc_attr( $val ) . '" class="regular-text" />';
			echo '<p class="description">El token de acceso de usuario (User Access Token) o el de la plataforma.</p>';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);
} );

/**
 * Render the settings page
 */
function datamaq_render_chatwoot_settings() {
	?>
	<div class="wrap">
		<h1>ChatWoot Integration</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'chatwoot_settings_group' );
			do_settings_sections( 'chatwoot-settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}
