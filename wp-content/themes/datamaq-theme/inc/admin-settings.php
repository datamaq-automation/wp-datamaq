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
	add_submenu_page(
		'datamaq-costs',
		'ChatWoot Integration',
		'ChatWoot API',
		'manage_options',
		'chatwoot-settings',
		'datamaq_render_chatwoot_settings'
	);

	add_submenu_page(
		'datamaq-costs',
		'Observabilidad de Leads',
		'Observabilidad',
		'manage_options',
		'datamaq-leads-log',
		'datamaq_render_leads_log'
	);
} );

/**
 * Register settings, sections and fields
 */
add_action( 'admin_init', function () {
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_base_url' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_website_token' );
	register_setting( 'chatwoot_settings_group', 'datamaq_app_secret' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_api_token' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_account_id' );
	register_setting( 'chatwoot_settings_group', 'datamaq_chatwoot_inbox_id' );

	add_settings_section(
		'chatwoot_main_section',
		'Configuración de ChatWoot & Seguridad',
		function () {
			echo '<p>Configure las credenciales para la conexión del widget y la seguridad de la API.</p>';
		},
		'chatwoot-settings'
	);

	add_settings_field(
		'datamaq_chatwoot_base_url',
		'ChatWoot Base URL',
		function () {
			$val = get_option( 'datamaq_chatwoot_base_url', 'https://chatwoot.datamaq.com.ar' );
			echo '<input type="text" name="datamaq_chatwoot_base_url" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="https://chatwoot.datamaq.com.ar" />';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);

	add_settings_field(
		'datamaq_chatwoot_website_token',
		'Website Token (Widget)',
		function () {
			$val = get_option( 'datamaq_chatwoot_website_token' );
			echo '<input type="text" name="datamaq_chatwoot_website_token" value="' . esc_attr( $val ) . '" class="regular-text" placeholder="EaFpQ..." />';
			echo '<p class="description">Identificador único del widget de Chatwoot.</p>';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);

	add_settings_field(
		'datamaq_app_secret',
		'App Secret (API Security)',
		function () {
			$val = get_option( 'datamaq_app_secret' );
			echo '<input type="password" name="datamaq_app_secret" value="' . esc_attr( $val ) . '" class="regular-text" />';
			echo '<p class="description">Secreto compartido para validar peticiones desde el frontend.</p>';
		},
		'chatwoot-settings',
		'chatwoot_main_section'
	);

	add_settings_section(
		'chatwoot_backend_section',
		'Configuración de Backend (Opcional)',
		function () {
			echo '<p>Credenciales para operaciones avanzadas del servidor.</p>';
		},
		'chatwoot-settings'
	);

	add_settings_field(
		'datamaq_chatwoot_api_token',
		'User Access Token',
		function () {
			$val = get_option( 'datamaq_chatwoot_api_token' );
			echo '<input type="password" name="datamaq_chatwoot_api_token" value="' . esc_attr( $val ) . '" class="regular-text" />';
		},
		'chatwoot-settings',
		'chatwoot_backend_section'
	);

	add_settings_field(
		'datamaq_chatwoot_account_id',
		'Account ID',
		function () {
			$val = get_option( 'datamaq_chatwoot_account_id' );
			echo '<input type="text" name="datamaq_chatwoot_account_id" value="' . esc_attr( $val ) . '" class="small-text" placeholder="1" />';
		},
		'chatwoot-settings',
		'chatwoot_backend_section'
	);
} );

/**
 * Render the settings page
 */
function datamaq_render_chatwoot_settings() {
	?>
	<div class="wrap datamaq-admin-page">
		<style>
			.datamaq-admin-page { max-width: 800px; margin-top: 20px; }
			.datamaq-admin-page h1 { color: #0c092f; font-weight: 700; margin-bottom: 20px; border-bottom: 2px solid #0c092f; padding-bottom: 10px; }
			.datamaq-admin-page .form-table th { width: 220px; padding: 20px 10px; font-weight: 600; color: #333; }
			.datamaq-admin-page .form-table td { padding: 15px 10px; }
			.datamaq-admin-page input[type="text"], .datamaq-admin-page input[type="password"] { 
				border-radius: 6px; border: 1px solid #ccc; padding: 8px 12px; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05); transition: border-color 0.2s;
			}
			.datamaq-admin-page input:focus { border-color: #0c092f; outline: none; box-shadow: 0 0 0 2px rgba(12, 9, 47, 0.1); }
			.datamaq-admin-page .button-primary { background: #0c092f !important; border-color: #0c092f !important; padding: 5px 25px !important; height: auto !important; line-height: 2 !important; border-radius: 6px !important; }
			.datamaq-admin-page .settings-error { border-radius: 6px; }
			.datamaq-admin-page .description { color: #666; font-style: italic; margin-top: 5px; }
			.datamaq-section-header { background: #f8f9fa; padding: 15px 20px; border-left: 4px solid #0c092f; margin: 30px 0 10px 0; border-radius: 0 6px 6px 0; }
			.datamaq-section-header h2 { margin: 0; font-size: 1.1rem; color: #0c092f; }
		</style>

		<h1>DataMaq - Integración ChatWoot</h1>
		
		<form method="post" action="options.php">
			<?php
			settings_fields( 'chatwoot_settings_group' );
			
			// Custom rendering for sections to add our headers
			global $wp_settings_sections, $wp_settings_fields;
			$page = 'chatwoot-settings';
			
			if ( isset( $wp_settings_sections[$page] ) ) {
				foreach ( (array) $wp_settings_sections[$page] as $section ) {
					echo '<div class="datamaq-section-header">';
					if ( $section['title'] ) {
						echo "<h2>{$section['title']}</h2>";
					}
					echo '</div>';
					
					if ( $section['callback'] ) {
						call_user_func( $section['callback'], $section );
					}
					
					if ( ! isset( $wp_settings_fields ) || ! isset( $wp_settings_fields[$page] ) || ! isset( $wp_settings_fields[$page][$section['id']] ) ) {
						continue;
					}
					
					echo '<table class="form-table" role="presentation">';
					do_settings_fields( $page, $section['id'] );
					echo '</table>';
				}
			}
			
			submit_button( 'Guardar Cambios Configuración' );
			?>
		</form>
	</div>
	<?php
}

/**
 * Render the Leads Log Dashboard
 */
function datamaq_render_leads_log() {
	$log_repo = new \DataMaq\Infrastructure\Lead\WPLeadLogRepository();
	$logs = $log_repo->getLastLogs( 50 );
	?>
	<div class="wrap datamaq-admin-page">
		<style>
			.datamaq-log-table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
			.datamaq-log-table th { background: #0c092f; color: #fff; text-align: left; padding: 15px; font-weight: 600; }
			.datamaq-log-table td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 0.9rem; }
			.datamaq-log-table tr:last-child td { border-bottom: none; }
			.status-badge { padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
			.status-success { background: #d4edda; color: #155724; }
			.status-error { background: #f8d7da; color: #721c24; }
			.utm-tag { display: inline-block; background: #e9ecef; color: #495057; padding: 2px 6px; border-radius: 3px; margin: 2px; font-size: 0.7rem; }
			.trace-id { font-family: monospace; color: #888; font-size: 0.8rem; }
		</style>

		<h1>Observabilidad de Leads - Últimos 50 eventos</h1>
		<p>Listado en tiempo real de los leads procesados por el sistema unificado.</p>

		<table class="datamaq-log-table">
			<thead>
				<tr>
					<th>Fecha/Hora</th>
					<th>Contacto</th>
					<th>Estado</th>
					<th>Atribución / UTMs</th>
					<th>ID de Trazabilidad</th>
				</tr>
			</thead>
			<tbody>
				<?php if ( empty( $logs ) ) : ?>
					<tr>
						<td colspan="5" style="text-align:center; padding: 40px;">No hay eventos registrados aún.</td>
					</tr>
				<?php else : ?>
					<?php foreach ( $logs as $log ) : ?>
						<tr>
							<td><?php echo esc_html( $log['timestamp'] ); ?></td>
							<td>
								<strong><?php echo esc_html( $log['name'] ); ?></strong><br>
								<span style="color: #666;"><?php echo esc_html( $log['email'] ); ?></span>
							</td>
							<td>
								<?php if ( $log['success'] ) : ?>
									<span class="status-badge status-success">Sincronizado</span>
								<?php else : ?>
									<span class="status-badge status-error">Error Sync</span>
								<?php endif; ?>
							</td>
							<td>
								<?php 
								$mkt = $log['marketing'] ?? array();
								$utm_keys = array( 'utm_source', 'utm_medium', 'utm_campaign' );
								foreach ( $utm_keys as $key ) {
									if ( ! empty( $mkt[$key] ) ) {
										echo '<span class="utm-tag">' . esc_html( $key . ': ' . $mkt[$key] ) . '</span>';
									}
								}
								if ( ! empty( $mkt['landing_page'] ) ) {
									echo '<br><small style="color: #999;">Landing: ' . esc_html( parse_url( $mkt['landing_page'], PHP_URL_PATH ) ) . '</small>';
								}
								?>
							</td>
							<td class="trace-id"><?php echo esc_html( $log['id'] ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}
